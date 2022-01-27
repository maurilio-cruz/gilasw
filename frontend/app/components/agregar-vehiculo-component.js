import Component from '@glimmer/component';
import { action } from '@ember/object';
import { tracked } from '@glimmer/tracking';

export default class AgregarVehiculoComponentComponent extends Component {
  @tracked hasError = false;

  @action
  agregarVehiculo() {
    $('#tipoFormControlSelect').val(null);
    $('#potenciaMotorFormControlText').val('');
    $('#vehiculoModal').modal('show');
  }

  @action
  closeModal() {
    $('#vehiculoModal').modal('hide');
  }

  @action
  sendForm() {
    if (
      $('#tipoFormControlSelect').val() == null ||
      $('#tipoFormControlSelect').val() === undefined
    ) {
      this.hasError = true;
      return;
    }

    if (
      $('#potenciaMotorFormControlText').val() == '' ||
      $('#potenciaMotorFormControlText').val() === undefined
    ) {
      this.hasError = true;
      return;
    }

    var params = {
      tipo_vehiculo: $('#tipoFormControlSelect').val(),
      potencia_motor: $('#potenciaMotorFormControlText').val(),
    };

    var self = this;

    $.ajax({
      type: 'POST',
      url: 'http://localhost:8080/index.php/gilasw/vehiculo/agregar',
      data: params,
      success: function (response) {
        var responseObject = JSON.parse(response);
        if (responseObject.success != true) {
          self.hasError = true;
          return;
        }
        window.reloadData();
        $('#vehiculoModal').modal('hide');
      },
    });
  }
}
