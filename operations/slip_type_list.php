<?php
include '../header.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">  
    <script type="text/javascript">
        var url;
        function newItem() {
            $('#icon-ok').show();
            $('#password').show();
            $('#dlg').dialog('open').dialog('setTitle', 'Yeni');
            $('#fm').form('clear');
            url = 'slip_type_operations.php?op=0';
        }
        function editItem() {
            var row = $('#dg').datagrid('getSelected');
            if (row) {
                $('#dlg').dialog('open').dialog('setTitle', 'Düzenle');
                $('#fm').form('load', row);
                $('#icon-ok').show();
                $('#password').show();
                url = 'slip_type_operations.php?op=1&id=' + row.id;
            }
        }
        function viewItem() {
            var row = $('#dg').datagrid('getSelected');
            if (row) {
                $('#dlg').dialog('open').dialog('setTitle', 'Göster');
                $('#fm').form('load', row);
                $('#icon-ok').hide();
                $('#password').hide();
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
                $.messager.confirm('Onayla', 'Silmek isteediğinize emin misiniz?', function (r) {
                    if (r) {
                        $.post('slip_type_operations.php', {id: row.id, op: 2}, function (result) {
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
    </script>
</head>
<body>
<div id="wrapper">
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="content-main">
            <div class ="content-easyui" id="wrapper-grid">
                <table id="dg" title="Fiş Tipi Listesi" class="easyui-datagrid"                                
                       url="slip_type_operations.php?op=3"
                       toolbar="#toolbar" pagination="true" pageSize="20"
                       rownumbers="true" fitColumns="true" singleSelect="true"
                       data-options="onDblClickRow:function(){viewItem();}">
                    <thead>
                        <tr>
                            <th field="name" width="50px">Fiş Tipi</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <?php include '../footer.php'; ?>
        </div>
    </div>
</div> 
<div id="toolbar">
    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newItem()">Yeni</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-view" plain="true" onclick="viewItem()">Göster</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editItem()">Düzenle</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="removeItem()">Sil</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-refresh" plain="true" onclick="refreshList()">Yenile</a>
</div>
<div id="dlg" class="easyui-dialog" style="width:95%;height:170px;"
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

</body>
</html>