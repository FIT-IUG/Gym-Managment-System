// let links = document.querySelectorAll("header nav a")
// links.forEach(element => {
//     element.onclick = e => {
//         links.forEach( z =>{
//             z.classList.remove("active")
//         })
//         e.preventDefault();
//         element.classList.add("active")
//     }
// });



let circularProgressone = document.querySelector(".circularPprogress01"),
progressValueone = document.querySelector(".progressValue01");

let progressStartValueone = 0,    
progressEndValueone = 50,    
speedone = 20;

let progressone = setInterval(() => {
  progressStartValueone++;

progressValueone.textContent = `${progressStartValueone}%`
circularProgressone.style.background = `conic-gradient(var(--yallow) ${progressStartValueone * 3.6}deg, #1f1c1c 0deg)`

if(progressStartValueone == progressEndValueone){
    clearInterval(progressone);
}    
}, speedone);

