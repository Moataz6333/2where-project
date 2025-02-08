
let places =document.getElementById("places");
let rests =document.getElementById("rests");
let hotels =document.getElementById("hotels");

let placesInput =document.getElementsByName("places")[0];
let restsInput =document.getElementsByName("rests")[0];
let hotelsInput =document.getElementsByName("hotels")[0];
function closeAll(){
    places.style.display="none";
    rests.style.display="none";
    hotels.style.display="none";
    for (var i = 0; i < placesInput.options.length; i++) {
        placesInput.options[i].selected = false;
    }
    for (var i = 0; i < restsInput.options.length; i++) {
        restsInput.options[i].selected = false;
    }
    for (var i = 0; i < hotelsInput.options.length; i++) {
        hotelsInput.options[i].selected = false;
    }
}
closeAll();

let type =document.getElementsByName('type');
type.forEach((e)=>{
    e.addEventListener('click',()=>{
        if (e.value == "none") {
            closeAll();
        } else {
            
            closeAll();
            document.getElementById(`${e.value}`).style.display="block";
        }
    });
});