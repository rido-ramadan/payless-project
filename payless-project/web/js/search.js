function showResult(result) {
    var some = document.getElementById('result-some')
    var none = document.getElementById('result-none')
    if (result === true) {
        some.style.display = 'block';
        none.style.display = 'none';
    } else {
        some.style.display = 'none';
        none.style.display = 'block';
    }
}