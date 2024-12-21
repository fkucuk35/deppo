<?php
include '../header.php';
?>
    <script type="text/javascript">
        var url;
        function newItem() {
            $('#icon-ok').show();
            $('#password').show();
            $('#dlg').dialog('open').dialog('setTitle', 'Yeni');
            $('#fm').form('clear');
            url = 'stock_slip_operations.php?op=0';
        }
        function editItem() {
            var row = $('#dg').datagrid('getSelected');
            if (row) {
                $('#dlg').dialog('open').dialog('setTitle', 'Düzenle');
                $('#fm').form('load', row);
                $('#icon-ok').show();
                $('#password').show();
                url = 'stock_slip_operations.php?op=1&id=' + row.id;
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
                        $.post('stock_slip_operations.php', {id: row.id, op: 2}, function (result) {
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
                <table id="dg" title="Stok Fişi Listesi" class="easyui-datagrid"                                
                       url="stock_slip_operations.php?op=4"
                       toolbar="#toolbar" pagination="true" pageSize="20"
                       rownumbers="true" fitColumns="true" singleSelect="true"
                       data-options="onDblClickRow:function(){viewItem();}">
                    <thead>
                        <tr>
                            <th field="slip_type_name" width="10">Fiş Tipi</th>
                            <th field="slip_datetime" width="10">Fiş Tarih ve Saati</th>
                            <th field="slip_code" width="10">Fiş Kodu</th>
                            <th field="personel_name" width="10">Fiş İlgisi</th>
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
<div id="dlg" class="easyui-dialog" closed="true" buttons="#dlg-buttons"
     style="width: 30%;" modal="true"     
     data-options="onResize:function(){$(this).dialog('center');}">
    <form id="fm" method="post" novalidate style="margin-left: 30px; margin-right: 30px;">
	        <div  class="fitem" inline>
            <input type="hidden" name="id" id="id" class="easyui-numberbox"/> 
        </div> 	
        <div class="fitem inline" >
            <label>Fiş Tipi:</label>
            <input name="slip_type_id" id="slip_type_id" class="easyui-combobox" required="true" data-options="  
                   valueField: 'id',  
                   textField: 'name',  
                   url: 'slip_type_operations.php?op=4',"/>
        </div>
        <div class="fitem inline" >
            <label>Fiş Tarih ve Saati:</label>                    
            <input name="slip_datetime" id="slip_datetime" class="easyui-datetimebox" required="true"/>
        </div>
        <div class="fitem inline" >
            <label>Fiş Kodu</label>
            <input name="slip_code" id="slip_code" class="easyui-textbox" required="true"/> 
        </div>
        <div class="fitem inline" >
            <label>Fiş İlgisi</label>
            <input name="personel_id" id="personel_id" class="easyui-combobox" required="true" data-options="
                   valueField: 'id',  
                   textField: 'name',  
                   url: 'personel_operations.php?op=4',"/>		
        </div>
        <div  class="fitem" inline>
            <label>Açıklama</label>
            <textarea name="slip_comment" id="slip_comment" ></textarea>
        </div>   
        <div  class="fitem" inline>
            <label>Ekler</label>
            <input type="hidden" name="slip_attachment" id="slip_attachment" class="easyui-textbox"/> 
        </div> 		
    </form>
</div>
<div id="dlg-buttons">
    <a id="icon-ok" href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveItem()">Kaydet</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">İptal</a>
</div>

<?php
include '../footer.php';
?>