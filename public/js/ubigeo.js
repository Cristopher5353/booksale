function getProvinces() {
    let id = $("#departament").val();
    $.ajax({
        url: '/getProvincesByDepartament',
        data: {
            id: id,
        },
        type: 'GET',
        datatype: 'JSON',
        success: function (resp) {
            $("#province").empty();
            $("#district").empty();

            $("#district").empty().append("<option disabled='disabled' selected>Seleccione</option>");
            let select = $("#province").empty().append("<option disabled='disabled' selected>Seleccione</option>");
            
            resp.provinces.forEach(function(province, index){

                select.append($('<option>', {
                    value: province.id,
                    text: province.name
                }));
            });
        }
    })
};

function getDistricts() {
    let id = $("#province").val();
    $.ajax({
        url: '/getDistrictsByProvince',
        data: {
            id:id,
        },
        type: 'GET',
        datatype: 'JSON',
        success: function (resp) {
            $("#district").empty();

            let select = $("#district").empty().append("<option disabled='disabled' selected>Seleccione</option>");

            resp.districts.forEach(function(province, index){

                select.append($('<option>', {
                    value: province.id,
                    text: province.name
                }));
            });
        }
    })
};