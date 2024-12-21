<?php

require "libs/variables.php";
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
        $('#active').checkbox({
            checked: true
        });
        document.getElementById("active_status").value = "ü";
        url = 'operations/personel_operations.php?op=0';
    }
    function editItem() {
        var row = $('#dg').datagrid('getSelected');
        if (row) {
            $('#dlg').dialog('open').dialog('setTitle', 'Düzenle');
            $('#fm').form('load', row);
            $('#active').checkbox({
                checked: (row.active == 'ü')
            });
            $('#icon-ok').show();
            url = 'operations/personel_operations.php?op=1&id=' + row.id;
        }
    }

    function saveItem() {
        $('#active_status').val(($('#fm').serialize().indexOf('active=') >= 0) ? "ü" : "");
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
                    $.post('operations/personel_operations.php', {id: row.id, op: 2}, function (result) {
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
    function formatActive(val, row) {
        if (val == 'ü') {
            return '<span style="font-family: wingdings">' + val + '</span>';
        } else {
            return val;
        }
    }
    function formatImage(val, row, index) {
        if (val == "") {
            return '<image src="assets/images/personels/no-image.jpg" width="32" height="42"/>';
        } else {
            return '<image src="assets/images/personels/' + val + '" width="32" height="42"/>';
        }
    }
</script>
<div id="wrapper" style="margin:5px">
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="content-main">
            <div class="content-easyui" id="wrapper-grid">
                <table id="dg" title="Personel Listesi" class="easyui-datagrid"
                       url="operations/personel_operations.php?op=3" toolbar="#toolbar" pagination="true" pageSize="20"
                       rownumbers="true" fitColumns="true" singleSelect="true">
                    <thead>
                        <tr>
                            <th field="active" data-options="formatter:formatActive">Aktif</th>
                            <th field="image_url" data-options="formatter:formatImage">Resim</th>
                            <th field="name" width="50px">Personel Adı</th>
                            <th field="surname" width="50px">Personel Soyadı</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<div id="toolbar">
    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newItem()">Yeni</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editItem()">Düzenle</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="removeItem()">Sil</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-reload" plain="true" onclick="refreshList()">Yenile</a>
</div>
<div id="dlg" class="easyui-dialog" closed="true" buttons="#dlg-buttons" modal="true"
     data-options="onResize:function(){$(this).dialog('center');}">
    <form id="fm" method="post" novalidate>
        <div class="fitem">
            <label>Aktif</label>
            <input name="active" id="active" class="easyui-checkbox" required="true"/>
            <input name="active_status" id="active_status" type="hidden"/>
        </div>
        <div class="fitem">
            <label>Personel Adı:</label>
            <input name="name" class="easyui-validatebox" required="true"/>
        </div>
        <div class="fitem">
            <label>Personel Soyadı:</label>
            <input name="surname" class="easyui-validatebox" required="true"/>
        </div>
    </form>
</div>
<div id="dlg-buttons">
    <a id="icon-ok" href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveItem()">Kaydet</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-cancel"
       onclick="javascript:$('#dlg').dialog('close')">İptal</a>
</div>
<?php include "partials/_footer.php"; ?>