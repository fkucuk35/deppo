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
        $('#password').show();
        $('#dlg').dialog('open').dialog('setTitle', 'Yeni');
        $('#fm').form('clear');
        url = 'operations/receipt_type_operations.php?op=0';
    }

    function viewItem() {
        var row = $('#dg').datagrid('getSelected');
        if (row) {
            $('#dlg').dialog('open').dialog('setTitle', 'Görüntüle');
            $('#fm').form('load', row);
            $("#fm :input").prop("disabled", true);
            $('#icon-ok').hide();
        }
    }

    function editItem() {
        var row = $('#dg').datagrid('getSelected');
        if (row) {
            $('#dlg').dialog('open').dialog('setTitle', 'Düzenle');
            $('#fm').form('load', row);
            $('#icon-ok').show();
            $('#password').show();
            url = 'operations/receipt_type_operations.php?op=1&id=' + row.id;
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
                    $('#dlg').dialog('close');		// close the dialog
                    $('#dg').datagrid('reload');	// reload the list
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
                    $.post('operations/receipt_type_operations.php', {id: row.id, op: 2}, function (result) {
                        if (result.success) {
                            $('#dg').datagrid('reload');	// reload the list
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
        $('#dg').datagrid('reload');	// reload the list
    }
    $(window).resize(function () {
        $('#dg').datagrid('resize');
    });
    $(function () {
        $('#dg').datagrid('enableFilter');
    });
</script>
</head>
<body>
<div id="wrapper">
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="content-main">
            <div class ="content-easyui" id="wrapper-grid">
                <table id="dg" title="Fiş Tipi Listesi" class="easyui-datagrid"                                
                       url="operations/receipt_type_operations.php?op=3"
                       toolbar="#toolbar" pagination="true" pageSize="10" pageList="[10]"
                       rownumbers="true" fitColumns="true" singleSelect="true"
                       data-options="onDblClickRow:function(){viewItem();}">
                    <thead>
                        <tr>
                            <th field="name" width="50px">Fiş Tipi</th>
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
     data-options="onResize:function(){$(this).dialog('center');}">
    <form id="fm" method="post" novalidate>
        <div class="fitem">
            <label>Fiş Tipi:</label>
            <input name="name" class="easyui-validatebox" required="true">
        </div>        
    </form>
</div>
<div id="dlg-buttons">
    <a id="icon-ok" href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveItem()">Kaydet</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">İptal</a>
</div>
<?php include "partials/_footer.php"; ?>