<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro de estudiantes</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/nav.css" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    .navbar-brand img {
      max-height: 60px;
    }

    .main-content {
      padding: 20px 0;
    }

    .table-container {
      background: white;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      padding: 20px;
      margin-bottom: 20px;
    }

    .toolbar {
      margin-bottom: 15px;
      padding: 10px 0;
      border-bottom: 1px solid #dee2e6;
    }

    footer {
      background-color: #f8f9fa;
      padding: 20px 0;
      margin-top: 40px;
      border-top: 1px solid #dee2e6;
    }

    .alert-container {
      position: fixed;
      top: 20px;
      right: 20px;
      z-index: 1050;
      min-width: 300px;
    }
  </style>
</head>

<body class="bg-light">
  <!-- Header -->
  <header>
    <img src="imagenes/descarga.png" height="auto" width="90%"></img>
  </header>


  <!-- Navigation -->
  <?php include 'nav.php'; ?>


  <!-- Main Content -->
  <div class="container main-content">
    <div class="row">
      <div class="col-12">
        <h2 class="mb-4">
          <i class="bi bi-people-fill"></i> Registro de estudiantes
        </h2>

        <div class="table-container">
          <!-- Toolbar -->
          <div class="toolbar" id="toolbar">
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-success" onclick="newUser()">
                <i class="bi bi-plus-circle"></i> Nuevo
              </button>
              <button type="button" class="btn btn-primary" onclick="editUser()">
                <i class="bi bi-pencil"></i> Editar
              </button>
              <button type="button" class="btn btn-danger" onclick="destroyUser()">
                <i class="bi bi-trash"></i> Eliminar
              </button>
            </div>

            <div class="btn-group ms-3" role="group">
              <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                <i class="bi bi-file-earmark-pdf"></i> Reportes
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="Reportes/ConFPDF/ReporteFPDF.php" target="_blank">
                    <i class="bi bi-file-pdf"></i> Reporte PDF con FPDF
                  </a></li>
                <li><a class="dropdown-item" href="Reportes/ConJasper/ReporteJasper.php" target="_blank">
                    <i class="bi bi-file-pdf"></i> Reporte PDF con Jasper
                  </a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="javascript:void(0)" onclick="reporteCedulaJasper()">
                    <i class="bi bi-person-badge"></i> Reporte Cédula con Jasper
                  </a></li>
                <li><a class="dropdown-item" href="javascript:void(0)" onclick="reporteCedulaFPDF()">
                    <i class="bi bi-person-badge"></i> Reporte Cédula con FPDF
                  </a></li>
              </ul>
            </div>
          </div>

          <!-- Estudiante Seleccionado -->
          <div class="alert alert-info" id="selectedStudentInfo" style="display: none;">
            <h6 class="mb-2"><i class="bi bi-person-check-fill"></i> Estudiante Seleccionado:</h6>
            <div id="selectedStudentDetails"></div>
          </div>

          <!-- Data Table -->
          <div class="table-responsive">
            <table class="table table-hover table-striped" id="studentsTable">
              <thead class="table-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Cédula</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Apellido</th>
                  <th scope="col">Dirección</th>
                  <th scope="col">Teléfono</th>
                </tr>
              </thead>
              <tbody id="studentsTableBody">
                <!-- Data will be loaded here -->
              </tbody>
            </table>
          </div>

          <!-- Pagination -->
          <nav aria-label="Paginación de estudiantes">
            <ul class="pagination justify-content-center" id="pagination">
              <!-- Pagination will be generated here -->
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>

  <!-- Student Modal -->
  <div class="modal fade" id="studentModal" tabindex="-1" aria-labelledby="studentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="studentModalLabel">Información del Usuario</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="studentForm" novalidate>
            <div class="mb-3">
              <label for="cedula" class="form-label">Cédula <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="cedula" name="cedula" required>
              <div class="invalid-feedback">
                Por favor ingrese la cédula.
              </div>
            </div>

            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="nombre" name="nombre" required>
              <div class="invalid-feedback">
                Por favor ingrese el nombre.
              </div>
            </div>

            <div class="mb-3">
              <label for="apellido" class="form-label">Apellido <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="apellido" name="apellido" required>
              <div class="invalid-feedback">
                Por favor ingrese el apellido.
              </div>
            </div>

            <div class="mb-3">
              <label for="direccion" class="form-label">Dirección <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="direccion" name="direccion" required>
              <div class="invalid-feedback">
                Por favor ingrese la dirección.
              </div>
            </div>

            <div class="mb-3">
              <label for="telefono" class="form-label">Teléfono <span class="text-danger">*</span></label>
              <input type="tel" class="form-control" id="telefono" name="telefono" required>
              <div class="invalid-feedback">
                Por favor ingrese el teléfono.
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            <i class="bi bi-x-circle"></i> Cancelar
          </button>
          <button type="button" class="btn btn-primary" onclick="saveUser()">
            <i class="bi bi-check-circle"></i> Guardar
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Confirmation Modal -->
  <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmModalLabel">Confirmar</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="confirmModalBody">
          ¿Estás seguro de eliminar este usuario?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Eliminar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Alert Container -->
  <div class="alert-container" id="alertContainer"></div>

  <footer class="text-center">
    <div class="container">
      <p class="mb-0">© 2025 Universidad Técnica de Ambato · FISEI</p>
    </div>
  </footer>

  <script>
    // Global variables
    var url;
    var currentPage = 1;
    var itemsPerPage = 10;
    var totalItems = 0;
    var studentsData = [];
    var selectedRow = null;

    $(document).ready(function () {
      loadStudents();
    });

    function loadStudents() {
      $.ajax({
        url: 'Models/get_users.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
          // El PHP devuelve {total: X, rows: [...]}
          studentsData = data.rows || [];
          totalItems = data.total || 0;
          renderTable();
          renderPagination();
        },
        error: function (xhr, status, error) {
          console.error('Error loading students:', error);
          showAlert('Error al cargar los datos: ' + error, 'danger');
        }
      });
    }
    function newUser() {
      $('#studentModalLabel').text('Nuevo Usuario');
      $('#studentForm')[0].reset();
      $('#studentForm').removeClass('was-validated');
      $('.form-control').removeClass('is-invalid');
      url = 'Models/save_user.php';

      var modal = new bootstrap.Modal(document.getElementById('studentModal'));
      modal.show();
    }

    // Edit user
    function editUser() {
      if (!selectedRow) {
        showAlert('Por favor, seleccione un estudiante para editar.', 'warning');
        return;
      }

      $('#studentModalLabel').text('Editar Usuario');
      $('#cedula').val(selectedRow.cedula);
      $('#nombre').val(selectedRow.nombre);
      $('#apellido').val(selectedRow.apellido);
      $('#direccion').val(selectedRow.direccion);
      $('#telefono').val(selectedRow.telefono);

      $('#studentForm').removeClass('was-validated');
      $('.form-control').removeClass('is-invalid');

      url = 'Models/update_user.php?cedulaVieja=' + selectedRow.cedula;

      var modal = new bootstrap.Modal(document.getElementById('studentModal'));
      modal.show();
    }

    // Save user
    function saveUser() {
      var form = document.getElementById('studentForm');

      if (!form.checkValidity()) {
        form.classList.add('was-validated');
        return;
      }

      var formData = new FormData(form);

      $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (result) {
          try {
            var response = typeof result === 'string' ? JSON.parse(result) : result;

            if (response.errorMsg) {
              showAlert(response.errorMsg, 'danger');
            } else {
              var modal = bootstrap.Modal.getInstance(document.getElementById('studentModal'));
              modal.hide();
              loadStudents();
              showAlert('Usuario guardado exitosamente', 'success');
            }
          } catch (e) {
            showAlert('Error al procesar la respuesta del servidor', 'danger');
          }
        },
        error: function () {
          showAlert('Error al guardar el usuario', 'danger');
        }
      });
    }

    // Delete user
    function destroyUser() {
      if (!selectedRow) {
        showAlert('Por favor, seleccione un estudiante para eliminar.', 'warning');
        return;
      }

      var modal = new bootstrap.Modal(document.getElementById('confirmModal'));
      modal.show();

      $('#confirmDeleteBtn').off('click').on('click', function () {
        $.ajax({
          url: 'Models/destroy_user.php',
          type: 'POST',
          data: { cedula: selectedRow.cedula },
          dataType: 'json',
          success: function (result) {
            if (result.success) {
              loadStudents();
              $('#selectedStudentInfo').hide();
              showAlert('Usuario eliminado exitosamente', 'success');
            } else {
              showAlert(result.errorMsg || 'Error al eliminar el usuario', 'danger');
            }

            var modal = bootstrap.Modal.getInstance(document.getElementById('confirmModal'));
            modal.hide();
            selectedRow = null;
          },
          error: function () {
            showAlert('Error al eliminar el usuario', 'danger');
            var modal = bootstrap.Modal.getInstance(document.getElementById('confirmModal'));
            modal.hide();
          }
        });
      });
    }

    // Report functions
    function reporteCedulaJasper() {
      if (!selectedRow) {
        showAlert('Por favor, seleccione un estudiante.', 'warning');
        return;
      }

      var cedula = encodeURIComponent(selectedRow.cedula);
      window.open('Reportes/ConJasper/ReporteJasperCedula.php?cedula=' + cedula, '_blank');
    }

    function reporteCedulaFPDF() {
      if (!selectedRow) {
        showAlert('Por favor, seleccione un estudiante.', 'warning');
        return;
      }

      var cedula = encodeURIComponent(selectedRow.cedula);
      window.open('Reportes/ConFPDF/ReporteFPDFCedula.php?cedula=' + cedula, '_blank');
    }
    function renderTable() {
      var tbody = $('#studentsTableBody');
      tbody.empty();

      var start = (currentPage - 1) * itemsPerPage;
      var end = start + itemsPerPage;
      var pageData = studentsData.slice(start, end);

      console.log('Renderizando tabla con datos:', pageData);

      pageData.forEach(function (student, index) {
        var isSelected = selectedRow && selectedRow.cedula == student.cedula ? 'table-primary' : '';
        var row = $(`
<tr data-cedula="${student.cedula}" data-id="${student.id || ''}" 
    class="${isSelected}" style="cursor: pointer;">
    <td>${start + index + 1}</td>
    <td>${student.cedula || ''}</td>
    <td>${student.nombre || ''}</td>
    <td>${student.apellido || ''}</td>
    <td>${student.direccion || ''}</td>
    <td>${student.telefono || ''}</td>
</tr>
`);
        tbody.append(row);
        console.log('Fila agregada con cédula:', student.cedula);
      });
    }

    function renderPagination() {
      var totalPages = Math.ceil(totalItems / itemsPerPage);
      var pagination = $('#pagination');
      pagination.empty();

      if (totalPages <= 1) return;

      // Previous button
      var prevClass = currentPage === 1 ? 'disabled' : '';
      pagination.append(`
                <li class="page-item ${prevClass}">
                    <a class="page-link" href="#" onclick="changePage(${currentPage - 1})">Anterior</a>
                </li>
            `);

      // Page numbers
      for (var i = 1; i <= totalPages; i++) {
        var activeClass = i === currentPage ? 'active' : '';
        pagination.append(`
                    <li class="page-item ${activeClass}">
                        <a class="page-link" href="#" onclick="changePage(${i})">${i}</a>
                    </li>
                `);
      }

      // Next button
      var nextClass = currentPage === totalPages ? 'disabled' : '';
      pagination.append(`
                <li class="page-item ${nextClass}">
                    <a class="page-link" href="#" onclick="changePage(${currentPage + 1})">Siguiente</a>
                </li>
            `);
    }

    // Change page
    function changePage(page) {
      var totalPages = Math.ceil(totalItems / itemsPerPage);
      if (page < 1 || page > totalPages) return;

      currentPage = page;
      renderTable();
      renderPagination();
      selectedRow = null;
      $('#selectedStudentInfo').hide(); // Ocultar info del estudiante
    }

    $(document).on('click', '#studentsTable tbody tr', function () {
      selectRow(this);
    });

    // Select row (versión mejorada con más debugging)
    function selectRow(row) {
      console.log('Función selectRow llamada');

      $('#studentsTable tbody tr').removeClass('table-primary');

      // Add selection to current row
      $(row).addClass('table-primary');

      // Store selected data
      var cedula = $(row).data('cedula');
      console.log('Cédula obtenida:', cedula);
      console.log('Datos de estudiantes disponibles:', studentsData);

      selectedRow = studentsData.find(student => student.cedula == cedula); // Usar == en lugar de ===
      console.log('Estudiante encontrado:', selectedRow);

      // Show selected student info
      if (selectedRow) {
        $('#selectedStudentDetails').html(`
                    <strong>Cédula:</strong> ${selectedRow.cedula} | 
                    <strong>Nombre:</strong> ${selectedRow.nombre} ${selectedRow.apellido} | 
                    <strong>Teléfono:</strong> ${selectedRow.telefono}
                `);
        $('#selectedStudentInfo').show();
        console.log('Información del estudiante mostrada');
      } else {
        console.log('No se encontró el estudiante con cédula:', cedula);
        $('#selectedStudentInfo').hide();
      }
    }

    // New 
    // Show alert
    function showAlert(message, type) {
      var alertId = 'alert-' + Date.now();
      var alertHtml = `
                <div class="alert alert-${type} alert-dismissible fade show" id="${alertId}" role="alert">
                    <i class="bi bi-${getAlertIcon(type)}"></i> ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;

      $('#alertContainer').append(alertHtml);

      // Auto remove after 5 seconds
      setTimeout(function () {
        $('#' + alertId).alert('close');
      }, 5000);
    }

    // Get alert icon
    function getAlertIcon(type) {
      switch (type) {
        case 'success': return 'check-circle-fill';
        case 'danger': return 'exclamation-triangle-fill';
        case 'warning': return 'exclamation-triangle-fill';
        case 'info': return 'info-circle-fill';
        default: return 'info-circle-fill';
      }
    }
  </script>
</body>

</html>