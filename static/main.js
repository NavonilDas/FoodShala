/**
 * Delete item from cart
 * @param {string} base Base Url of Website.
 * @param {number} id Cart Item id.
 */
function deleteCart(base, id) {
	$.post(base + 'cart/delete/' + id, {}, function (data, status) {
		console.log(data);
		if (data.error) {
			alert(data.error);
		} else {
			// TODO: Not to reload Site.
			window.location.reload();
		}
	});
}
