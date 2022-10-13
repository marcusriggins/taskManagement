var el = document.getElementById('task-list');
Sortable.create(el, { animation: 100, group: 'list-group', draggable: '.list-group-item', handle: '.list-group-item', sort: true, filter: '.sortable-disabled'});
$("#task-list").change(function(){
    const orders = [];
    $("li").each(function(element){
        orders.push($(this).find("div").attr("data-id"));
    });
    console.log(orders);
    $.ajax({
        url:"/order-task",
        type:'post',
        data: {order:orders},
        headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    },
        success:function(req) {
            const data = JSON.parse(req);
            console.log(data);
        },
        error: function(ts) {
            console.log(ts);
        }
    });
});

$(".edit").click(function(){
    let id = $(this).parent().parent().data("id");
    let name = $(this).parent().parent().data("name");
    let project = $(this).parent().parent().data("project");

    $("#edit-Modal input[name=id]").val(id);
    $("#edit-Modal input[name=name]").val(name);
    $(`#edit-Modal select[name=project] option[value=${project}]`).prop("selected", true);
    
});

$(".remove").click(function(){
    let id = $(this).parent().parent().data("id");
    $("#delete-Modal input[name=id]").val(id);
});

$("#filter").change(function(){
    let selected_project = $(this).val();
    
    if (selected_project == "all"){ $("li").show(); }
    else {
        $("li").hide();
        $("li").each(function(){
            let project = $(this).find(".task").data("project");
            if (project == selected_project) $(this).show();
        });
    }
});