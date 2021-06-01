$(document).on("click", ".service_sub_category_package", function () {

if ($(".service_sub_category_package:checkbox:checked").length > 0) {

if($("#service_category_id").val() != ''){

if ($(".service_sub_category:checkbox:checked").length > 0) {
$("#get-orders").removeAttr("disabled");
} else {
$("#get-orders").attr("disabled", "disabled");
}
}else{
$("#get-orders").removeAttr("disabled");
}

} else {

if($("#service_category_id").val() != ''){

if ($(".service_sub_category:checkbox:checked").length > 0) {
$("#get-orders").removeAttr("disabled");
} else {
$("#get-orders").attr("disabled", "disabled");
}
}else{
$("#get-orders").attr("disabled", "disabled");
}

}
});

$(document).on("click", ".service_sub_category", function () {

if($("#service_category_id").val() != ''){

if ($(".service_sub_category:checkbox:checked").length > 0) {
$("#get-orders").removeAttr("disabled");
} else {
$("#get-orders").attr("disabled", "disabled");
}
}else{
$("#get-orders").removeAttr("disabled");
}

});
