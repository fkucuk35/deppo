<?php
require "libs/functions.php";
if (!isLoggedIn()) {
    header('Location: login.php');
}
?>
<?php include "partials/_header.php" ?>
<?php include "partials/_navbar.php" ?>
<script type="text/javascript">
    var url;
    function newItem() {
        $('#icon-ok').show();
        $('#dlg').dialog('open').dialog('setTitle', 'Yeni');
        $('#fm').form('clear');
        url = 'operations/order_list_operations.php?op=0';
        generateNumber();
    }

    function viewItem() {
        var row = $('#dg').datagrid('getSelected');
        if (row) {
            $('#dlg').dialog('open').dialog('setTitle', 'Görüntüle');
            $('#fm').form('load', row);
            $("#fm :input").prop("disabled", true);
            $('#icon-ok').hide();
            getDetail(row.id);
            $("#hh").hide();
        }
    }

    function editItem() {
        var row = $('#dg').datagrid('getSelected');
        if (row) {
            $('#dlg').dialog('open').dialog('setTitle', 'Düzenle');
            $('#fm').form('load', row);
            $("#fm :input").prop("disabled", false);
            $('#icon-ok').show();
            url = 'operations/order_list_operations.php?op=1&id=' + row.id;
            $("#hh").show();
        }
    }

    function saveItem() {
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
    function onClickRow(index) {
        if (editIndex != index) {
            if (endEditing()) {
                $('#tbl_details').datagrid('selectRow', index).datagrid('beginEdit', index);
                editIndex = index;
            } else {
                $('#tbl_details').datagrid('selectRow', editIndex);
            }
        }
    }

    function addOnCheck(detail, allList) {
        var r = rows[i];
        checkedIds[r.stock_id] = r;
        /*        for (var i in checkedRows) {
         var cr = checkedRows[i];
         if (!checkedIds.hasOwnProperty(cr.id)) {
         $.ajax({
         type: "POST",
         url: "customer_operations.php",
         data: {op: 5, customer_id: customer_id, product_category_id: cr.product_category_id},
         dataType: "json",
         async: false,
         success: function (result) {
         //get discount and calculate new price.
         var dicount_price = cr.list_price;
         var discount = 0;
         if (result.length > 0) {
         discount = result[0].value;
         dicount_price = cr.list_price - (cr.list_price * discount / 100);
         }
         $(detail).datagrid('appendRow', {
         product_id: cr.id,
         stock_code: cr.stock_code,
         name: cr.name,
         product_category_id: cr.product_category_id,
         discount: discount,
         quantity: 1,
         list_price: cr.list_price,
         discount_price: dicount_price,
         due_date: ''
         });
         },
         error: function (jqXHR, textStatus, errorThrown) {
         alert(jqXHR.responseText);
         }
         });
         }
         }*/
    }

    function unCheck() {
        $('#tbl_stock_card_list').datagrid('uncheckAll');
    }

    $(function () {
        $('#dg').datagrid('enableFilter');
    });
    var checkedRows = [];
    function getCheckedBeforeAdd(allList) {
        var rows = $(allList).datagrid('getChecked');
        checkedRows = [];
        for (var i = 0; i < rows.length; i++) {
            checkedRows[i] = rows[i];
        }
    }

    var editIndex = undefined;
    function endEditing() {
        if (editIndex == undefined) {
            return true
        }
        if ($('#tbl_details').datagrid('validateRow', editIndex)) {
            $('#tbl_details').datagrid('endEdit', editIndex);
            editIndex = undefined;
            return true;
        } else {
            return false;
        }
    }

    function removeit() {
        if (editIndex == undefined) {
            return;
        }
        $('#tbl_details').datagrid('cancelEdit', editIndex)
                .datagrid('deleteRow', editIndex);
        editIndex = undefined;
    }

    function accept() {
        if (endEditing()) {
            $('#tbl_details').datagrid('acceptChanges');
        }
    }

    function reject() {
        $('#tbl_details').datagrid('rejectChanges');
        editIndex = undefined;
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

    $(function () {
        $('#tbl_stock_card_list').datagrid('enableFilter');
        $('#tbl_details').datagrid({
            singleSelect: true,
            idField: 'id',
            url: '',
            columns: [[
                    {field: 'id', hidden: true},
                    {field: 'order_id', hidden: true},
                    {field: 'stock_id', hidden: true},
                    {field: 'code', title: 'Stok Kartı Kodu', width: 50},
                    {field: 'name', title: 'Stok Kartı Adı', width: 50},
                    {field: 'ordered_quantity', title: 'Sipariş Edilen Miktar', width: 50},
                    {field: 'received_quantity', title: 'Teslim Alınan Miktar', width: 50},
                    {field: 'description', title: 'Açıklama', width: 50}
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
            }
        });
    }, 'json');
// Detail Functions End

</script>
<div id="wrapper" style="margin:5px">
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="content-main">
            <div class="content-easyui" id="wrapper-grid">
                <table id="dg" title="Sipariş Listesi" class="easyui-datagrid"
                       url="operations/order_list_view_operations.php?op=3"
                       toolbar="#toolbar" pagination="true" pageSize="20"
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
     data-options="onResize:function(){$(this).dialog('center');}" style="width:90%;height:500px">
    <form id="fm" method="post" novalidate>
        <div class="fitem inline">
            <label>Sipariş Numarası:</label>
            <input name="number" id="number" class="easyui-validatebox" data-options="editable: false"/>
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
        <div class="fitem" id="div_tbl_details">
            <table id="tbl_details" class="easyui-datagrid"
                   toolbar="#toolbarDetail" rownumbers="true" autoRowHeight="false" fitColumns="true" singleSelect="true" 
                   data-options="header:'#hh', scrollbarSize: 0, onClickRow: onClickRow">
            </table>  
        </div>
        <div id="hh">
            <div class="m-toolbar">
                <div class="m-title">Stok Kartları Listesi</div>
                <div class="m-right">
                    <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-add',plain:true" onclick="javascript:$('#dlg_detail').dialog('open');"></a>
                    <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-remove',plain:true" onclick="removeit()"></a>
                    <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-save',plain:true" onclick="accept()"></a>
                    <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-undo',plain:true" onclick="reject()"></a>
                </div>
            </div>
        </div>
        <!--datagrid details end-->
    </form>
</div>
<div id="dlg-buttons">
    <a id="icon-ok" href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveItem()">Kaydet</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">İptal</a>
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
           singleSelect: true,
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
    <a id="icon-addCheck" href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="addOnCheck('#tbl_details', '#tbl_stock_card_list');
            $('#dlg_detail').dialog('close');"><?php echo $lang['add'] ?> </a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg_detail').dialog('close');"><?php echo $lang['cancel'] ?> </a>
</div>  
<!--End new stock card-->