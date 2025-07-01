<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: Views/Login.php');
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Registro de estudiantes</title>
  <link rel="stylesheet" type="text/css" href="/Cuarto/css/servicios.css">
  <link rel="stylesheet" type="text/css" href="/Cuarto/css/nav.css">

  <link rel="stylesheet" type="text/css" href="/Cuarto/jquery/themes/default/easyui.css">
  <link rel="stylesheet" type="text/css" href="/Cuarto/jquery/themes/icon.css">
  <link rel="stylesheet" type="text/css" href="/Cuarto/jquery/themes/color.css">
  <link rel="stylesheet" type="text/css" href="/Cuarto/jquery/demo/demo.css">
  <script type="text/javascript" src="/Cuarto/jquery/jquery.min.js"></script>
  <script type="text/javascript" src="/Cuarto/jquery/jquery.easyui.min.js"></script>
</head>

<body>
  <header>
    <img src="/Cuarto/imagenes/descarga.png" height="auto" width="100%">
  </header>

  <?php include 'nav.php'; ?>


  <p>Registro de estudiantes</p>

  <table id="dg" title="Usuarios" class="easyui-datagrid" style="width:800px;height:300px"
  url="/Cuarto/Models/get_users.php"
  toolbar="#toolbar" pagination="true" rownumbers="true" fitColumns="true" singleSelect="true">
    <thead>
      <tr>
        <th field="cedula" width="50">Cédula</th>
        <th field="nombre" width="80">Nombre</th>
        <th field="apellido" width="50">Apellido</th>
        <th field="direccion" width="50">Dirección</th>
        <th field="telefono" width="50">Teléfono</th>
      </tr>
    </thead>
  </table>


  <?php if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'admin'): ?>
    <div id="toolbar">
      <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">Nuevo</a>
      <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true"
        onclick="editUser()">Editar</a>
      <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true"
        onclick="destroyUser()">Eliminar</a>
      <!-- ComboBox de reportes -->
      <select id="comboReportes" class="easyui-combobox" style="width:220px">
        <option value="">Seleccione un reporte...</option>
        <option value="reporteFPDF">Reporte PDF</option>
        <option value="reporteJasper">Reporte PDF con Jasper</option>
        <option value="reporteCedulaFPDF">Reporte PDF Cédula</option>
        <option value="reporteCedulaJasper">Reporte PDF Cédula con Jasper</option>
      </select>
      <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="verReporte()">Ver reporte</a>
    </div>
  <?php endif; ?>


  <div id="dlg" class="easyui-dialog" style="width:400px"
    data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
    <form id="fm" method="post" novalidate style="margin:0;padding:20px 50px">
      <h3>Información del Usuario</h3>
      <div style="margin-bottom:10px">
        <input name="cedula" class="easyui-textbox" required="true" label="Cédula:" style="width:100%">
      </div>
      <div style="margin-bottom:10px">
        <input name="nombre" class="easyui-textbox" required="true" label="Nombre:" style="width:100%">
      </div>
      <div style="margin-bottom:10px">
        <input name="apellido" class="easyui-textbox" required="true" label="Apellido:" style="width:100%">
      </div>
      <div style="margin-bottom:10px">
        <input name="direccion" class="easyui-textbox" required="true" label="Dirección:" style="width:100%">
      </div>
      <div style="margin-bottom:10px">
        <input name="telefono" class="easyui-textbox" required="true" label="Teléfono:" style="width:100%">
      </div>
    </form>
  </div>

  <div id="dlg-buttons">
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()"
      style="width:90px">Guardar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel"
      onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancelar</a>

  </div>

    <?php if (isset($_SESSION['usuario']) && $_SESSION['rol'] === 'admin'): ?>
  <h3 style="margin:20px">Usuarios registrados</h3>
  <table id="dgLogueados" class="easyui-datagrid" style="width:700px;height:220px"
    url="/Cuarto/Models/get_logueados.php"
    toolbar="#toolbarUsuarios"
    pagination="true" rownumbers="true" fitColumns="true" singleSelect="true">
    <thead>
      <tr>
        <th field="id" width="30">ID</th>
        <th field="nombre" width="80">Nombre</th>
        <th field="contraseña" width="120">Contraseña</th>
        <th field="rol" width="60">Rol</th>
      </tr>
    </thead>
  </table>

  <div id="toolbarUsuarios">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUsuario()">Nuevo</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUsuario()">Editar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUsuario()">Eliminar</a>
  </div>

  <div id="dlgUsuario" class="easyui-dialog" style="width:400px"
    data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons-usuario'">
    <form id="fmUsuario" method="post" novalidate style="margin:0;padding:20px 50px">
      <h3>Información del Usuario</h3>
      <div style="margin-bottom:10px">
        <input name="nombre" class="easyui-textbox" required="true" label="Nombre:" style="width:100%">
      </div>
      <div style="margin-bottom:10px">
        <input name="contraseña" type="text" class="easyui-textbox" label="Contraseña:" style="width:100%">
      </div>
      <div style="margin-bottom:10px">
        <select name="rol" class="easyui-combobox" label="Rol:" style="width:100%">
          <option value="admin">Administrador</option>
          <option value="secretaria">Secretaria</option>
        </select>
      </div>
    </form>
  </div>

  <div id="dlg-buttons-usuario">
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUsuario()" style="width:90px">Guardar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgUsuario').dialog('close')" style="width:90px">Cancelar</a>
  </div>
<?php endif; ?>


  <script type="text/javascript">
    var url;
    function newUser() {
      $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Nuevo Usuario');
      $('#fm').form('clear');
      url = '/Cuarto/Models/save_user.php';
    }

    function editUser() {
      var row = $('#dg').datagrid('getSelected');
      if (row) {
        $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Editar Usuario');
        $('#fm').form('load', row);
        url = '/Cuarto/Models/update_user.php?cedulaVieja=' + row.cedula;
      }
    }

    function saveUser() {
      $('#fm').form('submit', {
        url: url,
        iframe: false,
        onSubmit: function () {
          return $(this).form('validate');
        },
        success: function (result) {
          var result = JSON.parse(result);
          if (result.errorMsg) {
            $.messager.show({
              title: 'Error',
              msg: result.errorMsg
            });
          } else {
            $('#dlg').dialog('close');
            $('#dg').datagrid('reload');
          }
        }
      });
    }

    function destroyUser() {
      var row = $('#dg').datagrid('getSelected');
      if (row) {
        $.messager.confirm('Confirmar', '¿Estás seguro de eliminar este usuario?', function (r) {
          if (r) {
            $.post('/Cuarto/Models/destroy_user.php', { cedula: row.cedula }, function (result) {
              if (result.success) {
                $('#dg').datagrid('reload');
              } else {
                $.messager.show({
                  title: 'Error',
                  msg: result.errorMsg
                });
              }
            }, 'json');
          }
        });
      }
    }
    function verReporte() {
  var reporte = $('#comboReportes').val();
  var row = $('#dg').datagrid('getSelected');
  if (reporte === "reporteFPDF") {
    window.open('/Cuarto/Reportes/ConFPDF/ReporteFPDF.php', '_blank');
  } else if (reporte === "reporteJasper") {
    window.open('/Cuarto/Reportes/ConJasper/ReporteJasper.php', '_blank');
  } else if (reporte === "reporteCedulaFPDF") {
    if (row) {
      var cedula = encodeURIComponent(row.cedula);
      window.open('/Cuarto/Reportes/ConFPDF/ReporteFPDFCedula.php?cedula=' + cedula, '_blank');
    } else {
      $.messager.alert('Aviso', 'Por favor, seleccione un estudiante.');
    }
  } else if (reporte === "reporteCedulaJasper") {
    if (row) {
      var cedula = encodeURIComponent(row.cedula);
      window.open('/Cuarto/Reportes/ConJasper/ReporteJasperCedula.php?cedula=' + cedula, '_blank');
    } else {
      $.messager.alert('Aviso', 'Por favor, seleccione un estudiante.');
    }
  } else {
    $.messager.alert('Aviso', 'Seleccione un tipo de reporte.');
  }
}

// CRUD de usuarios registrados
var urlUsuario = ''; // variable global para URL (crear o editar)

function newUsuario() {
  $('#dlgUsuario').dialog('open').dialog('center').dialog('setTitle', 'Nuevo Usuario');
  $('#fmUsuario').form('clear');
  urlUsuario = '/Cuarto/Models/save_usuario.php';
}

function editUsuario() {
  var row = $('#dgLogueados').datagrid('getSelected');
  if (row) {
    $('#dlgUsuario').dialog('open').dialog('center').dialog('setTitle', 'Editar Usuario');
    $('#fmUsuario').form('load', {
      nombre: row.nombre,
      contraseña: row.contraseña,
      rol: row.rol
    });
    urlUsuario = '/Cuarto/Models/update_usuario.php?idviejo=' + encodeURIComponent(row.id);
    console.log("URL de edición:", urlUsuario);
  }
}

function saveUsuario() {
  $('#fmUsuario').form('submit', {
    url: urlUsuario,
    iframe: false,
    onSubmit: function () {
      return $(this).form('validate');
    },
    success: function (result) {
      var res = typeof result === 'string' ? JSON.parse(result) : result;
      if (res.errorMsg) {
        $.messager.show({
          title: 'Error',
          msg: res.errorMsg
        });
      } else {
        $('#dlgUsuario').dialog('close');
        $('#dgLogueados').datagrid('reload');
      }
    }
  });
}

function destroyUsuario() {
  var row = $('#dgLogueados').datagrid('getSelected');
  if (!row) {
    $.messager.alert('Aviso', 'Por favor selecciona un usuario para eliminar.');
    return;
  }

  $.messager.confirm('Confirmar', '¿Estás seguro de eliminar este usuario?', function (r) {
    if (r) {
      $.post('/Cuarto/Models/destroy_usuario.php', { id: row.id }, function (result) {
        if (result.success) {
          $('#dgLogueados').datagrid('reload');
          $.messager.show({
            title: 'Éxito',
            msg: 'Usuario eliminado correctamente.'
          });
        } else {
          $.messager.show({
            title: 'Error',
            msg: result.errorMsg || 'Error desconocido al eliminar.'
          });
        }
      }, 'json').fail(function () {
        $.messager.show({
          title: 'Error',
          msg: 'No se pudo conectar con el servidor.'
        });
      });
    }
  });
}




  </script>
</body>
<footer>
  <p>© 2025 Universidad Técnica de Ambato · FISEI</p>
</footer>

</html>