// // var currentDate = new Date()
// // var day = currentDate.getDate()
// // var month = currentDate.getMonth() + 1
// // var year = currentDate.getFullYear()
// // console.log(year + '-' + month + '-' + day);


var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = today.getFullYear();

today = yyyy + '-' + mm + '-' + dd;
console.log(today)



