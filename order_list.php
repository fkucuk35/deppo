<?php
require "libs/functions.php";
if (!isLoggedIn()) {
    header('Location: login.php');
}
?>
<?php include "partials/_header.php" ?>
<?php include "partials/_navbar.php" ?>
<style type="text/css">
    .datagrid-cell {
        height: 30px !important;
    }
</style>
<script type="text/javascript">
    var url;
    var selected_order_id;
    var deleted_details = [];
    function newItem() {
        $('#icon-ok').show();
        $('#dlg').dialog('open').dialog('setTitle', 'Yeni');
        $("#fm :input").prop("disabled", false);
        $('#tbl_details').datagrid('showColumn', 'action');
        $('#fm').form('clear');
        url = 'operations/order_list_operations.php?op=0';
        generateNumber();
        deleteDetailTable();
        unCheck();
        $("#hh").show();
    }

    function viewItem() {
        var row = $('#dg').datagrid('getSelected');
        if (row) {
            $('#dlg').dialog('open').dialog('setTitle', 'Görüntüle');
            $('#fm').form('load', row);
            $("#fm :input").prop("disabled", true);
            $('#tbl_details').datagrid('hideColumn', 'action');
            $('#icon-ok').hide();
            getDetail(row.id);
            $("#hh").hide();
        }
    }

    function editItem() {
        var row = $('#dg').datagrid('getSelected');
        if (row) {
            selected_order_id = row.id;
            deleted_details = [];
            $('#dlg').dialog('open').dialog('setTitle', 'Düzenle');
            $('#fm').form('load', row);
            $("#fm :input").prop("disabled", false);
            $('#tbl_details').datagrid('showColumn', 'action');
            $('#icon-ok').show();
            url = 'operations/order_list_operations.php?op=1&id=' + row.id;
            getDetail(row.id);
            $("#hh").show();
        }
    }

    function saveItem() {
        $('#rows').val(JSON.stringify($('#tbl_details').datagrid('getRows')));
        $('#deleted_details').val(JSON.stringify(deleted_details));
        $('#fm').form('submit', {
            url: url,
            onSubmit: function () {
                return $(this).form('validate');
            },
            success: function (result) {
                var result = eval('(' + result + ')');
                if (result.success) {
                    $('#dlg').dialog('close'); // close the dialog
                    $('#dg').datagrid('reload'); // reload the list
                } else {
                    $.messager.show({
                        title: 'Hata oluştu!',
                        msg: result.msg
                    });
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(jqXHR.responseText);
            }
        });
    }

    function removeItem() {
        var row = $('#dg').datagrid('getSelected');
        if (row) {
            $.messager.confirm('Onayla', 'Silmek istediğinize emin misiniz?', function (r) {
                if (r) {
                    $.post('operations/order_list_operations.php', {
                        id: row.id,
                        op: 2
                    }, function (result) {
                        if (result.success) {
                            $('#dg').datagrid('reload'); // reload the list
                        } else {
                            $.messager.show({// show error message
                                title: 'Hata',
                                msg: result.msg
                            });
                        }
                    }, 'json');
                }
            });
        }
    }

    function removeDetail(index, rowId) {
        $.messager.confirm('Onayla', 'Silmek istediğinize emin misiniz?', function (r) {
            if (r) {
                if (typeof (rowId) !== 'undefined') {
                    deleted_details.push(rowId);
                }
                $('#tbl_details').datagrid('deleteRow', index);
                rows = $('#tbl_details').datagrid('getRows');
                $('#tbl_details').datagrid('loadData', {"total": rows.length, "rows": rows});
            }
        });
    }

    function refreshList() {
        $('#dg').datagrid('reload'); // reload the list
    }
    $(window).resize(function () {
        $('#dg').datagrid('resize');
    });
    function generateNumber() {
        $.ajax({
            type: "POST",
            url: "operations/order_list_operations.php",
            data: {
                op: 8
            },
            dataType: "json",
            success: function (result) {
                if (result.success) {
                    $('#number').val(result.orderNum);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(jqXHR.responseText);
            }
        });
    }

// Detail Fucntions Start

    function addOnCheck(detail, allList, order_id) {
        getCheckedBeforeAdd(allList);
        let addedRows = [];
        var isExists;
        var rows = $(detail).datagrid('getRows');
        for (var i = 0; i < checkedRows.length; i++)
        {
            isExists = false;
            for (var j = 0; j < rows.length; j++)
            {
                if (rows[j]["stock_id"] === checkedRows[i]["id"]) {
                    isExists = true;
                    break;
                }
            }
            if (!isExists)
                addedRows.push(checkedRows[i]);
        }
        for (var i = 0; i < addedRows.length; i++) {
            $('#tbl_details').datagrid('appendRow', {
                order_id: order_id,
                stock_id: addedRows[i].id,
                code: addedRows[i].code,
                name: addedRows[i].name,
                ordered_quantity: 0,
                received_quantity: 0,
                description: ""
            });
        }
        unCheck();
    }

    function unCheck() {
        $('#tbl_stock_card_list').datagrid('uncheckAll');
    }

    var checkedRows = [];
    function getCheckedBeforeAdd(allList) {
        var rows = $(allList).datagrid('getChecked');
        checkedRows = [];
        for (var i = 0; i < rows.length; i++) {
            checkedRows[i] = rows[i];
        }
    }

    function deleteDetailTable() {
        $('#tbl_details').datagrid('loadData', {"total": 0, "rows": []}); // empty the table data
    }

    function getDetail(id) {
        deleteDetailTable();
        $.post('operations/order_list_operations.php', {id: id, op: 9}, function (result) {
            for (var i = 0; i < result.length; i++) {
                $('#tbl_details').datagrid('appendRow', {
                    id: result[i].id,
                    order_id: result[i].order_id,
                    stock_id: result[i].stock_id,
                    code: result[i].code,
                    name: result[i].name,
                    ordered_quantity: result[i].ordered_quantity,
                    received_quantity: result[i].received_quantity,
                    description: result[i].description
                });
            }
        }, 'json').done(function () {

        }).fail(function () {

        });
    }

    function closeDialog() {
        $('#dlg').dialog('close');
    }

    $(function () {
        $('#tbl_details').datagrid({
            singleSelect: true,
            idField: 'id',
            url: '',
            columns: [[
                    {field: 'id', hidden: true},
                    {field: 'order_id', hidden: true},
                    {field: 'stock_id', hidden: true},
                    {field: 'code', title: 'Stok Kartı Kodu', width: 10},
                    {field: 'name', title: 'Stok Kartı Adı', width: 10},
                    {field: 'ordered_quantity', title: 'Sipariş Edilen', width: 5, editor: 'text'},
                    {field: 'received_quantity', title: 'Teslim Alınan', width: 5, editor: 'text'},
                    {field: 'description', title: 'Açıklama', width: 50, editor: 'text'},
                    {field: 'action', title: '', align: 'center', width: 20, formatter: formatAction}
                ]],
            onEndEdit: function (index, row) {

            },
            onBeforeEdit: function (index, row) {
                row.editing = true;
                $(this).datagrid('refreshRow', index);
            },
            onAfterEdit: function (index, row) {
                row.editing = false;
                $(this).datagrid('refreshRow', index);
            },
            onCancelEdit: function (index, row) {
                row.editing = false;
                $(this).datagrid('refreshRow', index);
            },
            rowStyler: function (index, row) {
                if (parseInt(row.ordered_quantity) > parseInt(row.received_quantity)) {
                    return 'background-color: #f8d7da; color: #721c24;font-weight: bold;';
                }
            }
        });
    }, 'json');

    // Detail Functions End
    $(function () {
        $('#dg').datagrid('enableFilter');
        $('#tbl_stock_card_list').datagrid('enableFilter');
    });

    function formatAction(value, row, index) {
        if (row.editing) {
            var s = '<button type="button" class="btn btn-success btn-sm" style="width: 60px; font-size: 10px; border-radius: 15px;" onclick="saverow(this)">Kaydet</button> ';
            var c = '<button type="button" class="btn btn-secondary btn-sm" style="width: 60px; font-size: 10px; border-radius: 15px;" onclick="cancelrow(this)">İptal</button>';
            return s + c;
        } else {
            var e = '<button type="button" class="btn btn-primary btn-sm" style="width: 60px; font-size: 10px; border-radius: 15px;" onclick="editrow(this)">Düzenle</button> ';
            var d = '<button type="button" class="btn btn-danger btn-sm" style="width: 60px; font-size: 10px; border-radius: 15px;" onclick="deleterow(this)">Sil</button>';
            return e + d;
        }
    }

    function getRowIndex(target) {
        var tr = $(target).closest('tr.datagrid-row');
        return parseInt(tr.attr('datagrid-row-index'));
    }
    function editrow(target) {
        $('#tbl_details').datagrid('beginEdit', getRowIndex(target));
    }
    function deleterow(target) {
        $.messager.confirm('Onay', 'Silmek istediğinize emin misiniz?', function (r) {
            if (r) {
                $('#tbl_details').datagrid('deleteRow', getRowIndex(target));
            }
        });
    }
    function saverow(target) {
        $('#tbl_details').datagrid('endEdit', getRowIndex(target));
    }
    function cancelrow(target) {
        $('#tbl_details').datagrid('cancelEdit', getRowIndex(target));
    }
    function insert() {
        /* var row = $('#table_details').datagrid('getSelected');
         if (row) {
         var index = $('#table_details').datagrid('getRowIndex', row);
         } else {
         index = 0;
         }
         $('#table_details').datagrid('insertRow', {
         index: index,
         row: {
         status: 'P'
         }
         });
         $('#table_details').datagrid('selectRow', index);
         $('#table_details').datagrid('beginEdit', index);*/
    }
    function myformatter(date) {
        var y = date.getFullYear();
        var m = date.getMonth() + 1;
        var d = date.getDate();
        return y + '-' + (m < 10 ? ('0' + m) : m) + '-' + (d < 10 ? ('0' + d) : d);
    }
    function myparser(s) {
        if (!s)
            return new Date();
        var ss = (s.split('-'));
        var y = parseInt(ss[0], 10);
        var m = parseInt(ss[1], 10);
        var d = parseInt(ss[2], 10);
        if (!isNaN(y) && !isNaN(m) && !isNaN(d)) {
            return new Date(y, m - 1, d);
        } else {
            return new Date();
        }
    }
</script>
<div id="wrapper" style="margin:5px">
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="content-main">
            <div class="content-easyui" id="wrapper-grid">
                <table id="dg" title="Sipariş Listesi" class="easyui-datagrid"
                       url="operations/order_list_view_operations.php?op=3"
                       toolbar="#toolbar" pagination="true" pageSize="10" pageList="[10]"
                       rownumbers="true" fitColumns="true" singleSelect="true" data-options="onDblClickRow:function(){viewItem();}">
                    <thead>
                        <tr>
                            <th field="number" width="50">Sipariş Numarası</th>
                            <th field="date" width="50">Tarih</th>
                            <th field="supplier_name" width="50">Tedarikçi Firma/Kurum</th>
                            <th field="description" width="100">Açıklama</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<div id="toolbar">
    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newItem()">Yeni</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-view" plain="true" onclick="viewItem()">Görüntüle</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editItem()">Düzenle</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="removeItem()">Sil</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-reload" plain="true" onclick="refreshList()">Yenile</a>
</div>
<div id="dlg" class="easyui-dialog"
     closed="true" buttons="#dlg-buttons" modal="true"
     data-options="onResize:function(){$(this).dialog('center');}" style="width:95%;height:500px">
    <form id="fm" method="post" novalidate>
        <div class="fitem inline">
            <label>Sipariş Numarası:</label>
            <input name="number" id="number" class="easyui-validatebox" data-options="editable: false"/>
        </div>
        <div class="fitem inline">
            <input name="date" id="date" class="easyui-datebox" required="true" label="Tarih" labelPosition="left"/>
        </div>
        <div class="fitem inline">
            <label>Tedarikçi Firma/Kurum:</label>
            <input name="supplier_id" class="easyui-combobox" required="true" data-options="  
                   valueField: 'id',  
                   textField: 'name',  
                   url: 'operations/supplier_operations.php?op=4',
                   editable: false
                   " />
        </div>
        <div class="fitem">
            <label>Açıklama:</label>
            <textarea name="description"></textarea>
        </div>

        <!--datagrid details start-->
        <div class="container-fluid px-1">      
            <div class="fitem" id="div_tbl_details">
                <table id="tbl_details" class="easyui-datagrid" style="width: 99%"
                       rownumbers="true" autoRowHeight="false" fitColumns="true" singleSelect="true" 
                       data-options="header:'#hh', scrollbarSize: 0">
                </table>  
            </div>
        </div>
        <div class="fitem">
            <textarea name="rows" id='rows' style='display: none'></textarea>
        </div>
        <div class="fitem">
            <textarea name="deleted_details" id='deleted_details' style='display: none'></textarea>
        </div>
        <!--datagrid details end-->
    </form>
</div>
<div id="hh">
    <div class="m-toolbar">
        <div class="m-title">Sipariş Detay Listesi</div>
        <div class="m-right">
            <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-add',plain:true" onclick="javascript:$('#dlg_detail').dialog('open');"></a>
            <!-- <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-remove',plain:true" onclick="removeDetail()"></a>
                     <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-save',plain:true" onclick="accept()"></a>
                     <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-undo',plain:true" onclick="reject()"></a> -->
        </div>
    </div>
</div>
<div id="dlg-buttons">
    <a id="icon-ok" href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveItem()">Kaydet</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="closeDialog()">İptal</a>
</div>
<?php include "partials/_footer.php"; ?>

<!--Add new stock card-->        
<div id="dlg_detail" class="easyui-dialog" style="width:90%;height:400px"
     closed="true" modal="true" buttons="#dlg-buttons-detail" title="Stok Kartları Listesi">
    <table id="tbl_stock_card_list" class="easyui-datagrid" style="width:100%;height:310px"  
           url="operations/stock_card_operations.php?op=5"
           data-options="
           rownumbers:true,
           autoRowHeight:false,
           idField:'id',   
           singleSelect: false,
           fitColumns:true">
        <thead>
            <tr>
                <th field="code" width="10">Stok Kartı Kodu</th>
                <th field="name" width="10">Stok Kartı Adı</th> 
                <th field="quantity" width="10" align="center">Stok Miktarı</th>                         
                <th field="ck" checkbox="true"></th>
            </tr>
        </thead>
    </table> 
</div>

<div id="dlg-buttons-detail">    
    <a id="icon-addCheck" href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="addOnCheck('#tbl_details', '#tbl_stock_card_list', selected_order_id);
            $('#dlg_detail').dialog('close');"><?php echo $lang['add'] ?> </a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg_detail').dialog('close');"><?php echo $lang['cancel'] ?> </a>
</div>  
<!--End new stock card-->