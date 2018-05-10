function searchInProduct(searchString) {
    $.get("assets/php/search.php?searchString=" + searchString, function(data){
		var product = "";
		var myObj = JSON.parse(data);
		for (var i = 0; i < myObj.names.length; i++) {
			product += '<div class="col-sm-6 item" data-bs-hover-animate="pulse">' + 
                    '<div class="row">' +
                        '<div class="col-md-12 col-lg-5"><a href="#"><img class="img-fluid" src="'+myObj.imageURLs[i]+'"></a></div>' +
                        '<div class="col">' + 
                            '<h3 class="name">' + myObj.names[i] + '</h3>' +
                            '<p class="description" dir="rtl">نام فروشنده : ' + myObj.companies[i] + '<br>رنگ : ' + myObj.colors[i] + '<br>' + myObj.prices[i] + ' ریال</p>' + 
							'<button class="btn btn-primary" type="button" onclick="purchaseProduct(' + myObj.ids[i] + ')" style="width:100px;margin:1px;background-color:#335687;font-size:16px;">خرید</button>' +
                            '<button class="btn btn-primary" type="button" onclick="productDetails(' + myObj.ids[i] + ')" style="height:38px;width:100px;margin:1px;background-color:#335687;font-size:16px;">جزئیات</button>' +
                        '</div>' +
                    '</div>' +
                '</div>';
		}
        document.getElementsByClassName("row projects")[0].innerHTML = product;
    });
}

function productDetails(id){
	console.log(id);
}