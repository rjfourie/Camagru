var btncomment = document.querySelectorAll('.btncomment')
var txtcmnt = document.querySelectorAll('.txtcmmnt')
var likes = document.querySelectorAll('.btnlike')
var xhttp = new XMLHttpRequest();


likes.forEach(function(like){
    like.addEventListener('click', function(){
        var id = like.parentNode.children[1].getAttributeNode('value').value
        console.log(id)
        xhttp.open("POST", "likescmnt.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(`id= ${id}`);
    })
})

btncomment.forEach(element => {
    element.addEventListener('click', function(){
        var id = element.parentNode.children[1].getAttributeNode('value').value
        console.log(element.parentElement.children)
        let cmt = element.parentElement.children[2].value;
        let tmp = {'id': id, 'cmnt': cmt};
        xhttp.open("POST", "likescmnt.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(`id=${id}&cmnt=${cmt}`);
        console.log(tmp.id);
        // window.location.href = 'likescmnt.php';
    })
});