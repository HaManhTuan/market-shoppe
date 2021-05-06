function number_format(number, decimals, dec_point, thousands_sep) {
    // * example 1: number_format(1234.5678, 2, '.', '');
    // * returns 1: 1234.57
    number = number.toString().replace(/[(,)|(.)]/g, "");

    var n = number, c = isNaN(decimals = Math.abs(decimals)) ? 2 : decimals;
    var d = dec_point == undefined ? "," : dec_point;
    var t = thousands_sep == undefined ? "." : thousands_sep, s = n < 0 ? "-" : "";
    var i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;

    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
}
// Hàm tính số ngày trong 1 tháng
function day_count(t, y) {
    let d;
    switch (t) {
        case 1:
        case 3:
        case 5:
        case 7:
        case 8:
        case 10:
        case 12:
            d = 31;
            break;
        case 4:
        case 6:
        case 9:
        case 11:
            d = 30;
            break;
        case 2:
            if(y % 100 != 0 && y % 4 == 0) {
                d = 29;
            } else {
                d = 28;
            }
            break;
        default:
            d = 0;
    }
    return d;
}