var tabla_conta = 0;
eventosconta();

function rendercontabilidad(params) {
    var table = document.createElement('table');
    table.setAttribute('class','table table-responsive');
    table.setAttribute('id','tabla-conta');
    var tbody = document.createElement('tbody');
    var thead = document.createElement('thead');
    thead.setAttribute('class','bg-white');
    tbody.setAttribute('class','body-real');

    var tr = document.createElement('tr');
    
    
    var th = document.createElement('th');
    th.innerHTML = "ID";
    tr.append(th);
    th = document.createElement('th');
    th.innerHTML = "CODIGO";
    tr.append(th);
    th = document.createElement('th');
    th.innerHTML = "DESCRIPCION";
    tr.append(th);
    th = document.createElement('th');
    th.innerHTML = "OPCIONES";
    tr.append(th);

    thead.append(tr);
    for (let index = 0; index < params.length; index++) {
        const element = params[index];
        
        tr = document.createElement('tr')
        tr.setAttribute('class','bg-white');
        let td = document.createElement('td');
        td.innerHTML = element.id;
        tr.append(td);

        td = document.createElement('td');
        td.innerHTML = element.codigo;
        tr.append(td);

        td = document.createElement('td');
        td.innerHTML = element.descripcion;
        tr.append(td);

        /*<td class="col">
            <form action="/imagen/delete">
                <input type="hidden" name="id" value="{{ $imagenes->id }}">
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
            </form>
        </td>*/
        td = document.createElement('td');
        let form = document.createElement('form');
        form.setAttribute('action','/contabilidad/delete');
        let input = document.createElement('input');
        input.setAttribute('type','hidden');
        input.setAttribute('value',element.id)
        input.setAttribute('name','id')
        form.append(input);
        input = document.createElement('button');
        input.setAttribute('class','btn btn-danger');
        input.setAttribute('type','submit');
        let i = document.createElement('i');
        i.setAttribute('class','fa fa-trash');
        input.append(i);
        form.append(input);
        td.append(form);
        tr.append(td);

        tbody.append(tr);

        if(index == (params.length - 1)){
            table.append(thead);
            table.append(tbody)
            let container = document.querySelector('#tabla-conta-div');
            container.innerHTML = "";
            container.append(table);

            if (tabla_conta == 0) {
                tabla_conta = $('#tabla-conta').DataTable({
                    "iDisplayLength": 5,
                    "aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
                });
            }
            else {
                tabla_conta.destroy();
                tabla_conta = $('#tabla-conta').DataTable({
                    "iDisplayLength": 5,
                    "aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
                });
            }
        }
    }  
}

function eventosconta(){
    var form = document.querySelector('#form_contabilidad_store');
    form.addEventListener('submit',function(e){
        e.preventDefault();
        console.log('sientrarecontramongol');
        let tag = document.querySelector('#form_contabilidad_store');
        var formdata = new FormData(tag);
        
        ejecutarruta(formdata,'/contabilidad/store', rendercontabilidad);
    });
    if (tabla_conta == 0) {
        tabla_conta = $('#tabla-conta').DataTable({
            "iDisplayLength": 5,
            "aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
        });
    }
    else {
        tabla_conta.destroy();
        tabla_conta = $('#tabla-conta').DataTable({
            "iDisplayLength": 5,
            "aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
        });
    }
}