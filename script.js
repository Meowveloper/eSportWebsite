const contentTag=document.querySelector(".content");
const toggleForm=document.querySelector(".fillForm");

toggleForm.addEventListener("click",()=>{
    if(contentTag.classList.contains("hidden"))
        {
contentTag.classList.remove("hidden");
toggleForm.textContent="Close Form"}

else{
    contentTag.classList.add("hidden");
    toggleForm.textContent="Fill Form";
}
})
