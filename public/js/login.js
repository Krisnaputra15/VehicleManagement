const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});

function switchPanel(panel){
    if(panel == 1){
        container.classList.add("right-panel-active");
    } else if(panel == 2){
        container.classList.remove("right-panel-active");
    }
}