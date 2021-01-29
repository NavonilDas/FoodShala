/**
 * Delete item from cart
 * 
 * @param {string} base Base Url of Website.
 * @param {number} id Cart Item id.
 */
function deleteCart(base, id) {
	var yes = confirm('Are you sure you want to delete item?.');
	if (!yes) return;
	$.post(base + 'cart/delete/' + id, {}, function (data, status) {
		if (data.error) {
			alert(data.error);
		} else {
			// TODO: Not to reload Site.
			window.location.reload();
		}
	});
}

/**
 * Change The Cart Quantity.
 * 
 * @param {string} base Base Url
 * @param {number} id Cart Item id.
 * @param {number} val Change in Quantity.
 * @param {boolean} refresh Button which is clicked.
 */
function cartQuantity(base, id, val, refresh = false) {
	var el = document.getElementById('cquantity-' + id);

	// if quantity is change to zero then delete item from cart.

	if (el) {
		var quantity = parseInt(el.innerText) + val;
		if (quantity === 0) {
			return deleteCart(base, id);
		}
	} else {
		return;
	}

	// Change the quantity in cart
	$.post(base + 'cart/quantity/' + id + '/' + val, {}, function (data, status) {
		if (data.error) {
			alert(data.error);
		} else {
			if(refresh){
				// TODO: Not to reload.
				return window.location.reload();
			}
			el.innerText = quantity;
		}
	});
}
