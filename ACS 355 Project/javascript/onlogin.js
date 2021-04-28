function home(){
    document.getElementById("home").classList.add('current');
    document.getElementById("userprofile").classList.remove('current');
    document.getElementById("discussions").classList.remove('current');
    document.getElementById("networks").classList.remove('current');
    document.getElementById("createnetwork").classList.remove('current');
    }
    function userprofile(){
         document.getElementById("home").classList.remove('current');
         document.getElementById("discussions").classList.remove('current');
         document.getElementById("networks").classList.remove('current');
        document.getElementById("userprofile").classList.add('current');
        document.getElementById("createnetwork").classList.remove('current');
    }
    function discussions(){
        document.getElementById("discussions").classList.add('current');
        document.getElementById("home").classList.remove('current');
         document.getElementById("userprofile").classList.remove('current');
         document.getElementById("networks").classList.remove('current');
         document.getElementById("createnetwork").classList.remove('current');
    }
    function networks(){
        document.getElementById("networks").classList.add('current');
        document.getElementById("home").classList.remove('current');
         document.getElementById("discussions").classList.remove('current');
         document.getElementById("userprofile").classList.remove('current');
         document.getElementById("createnetwork").classList.remove('current');
    }

    function createnetwork(){
        document.getElementById("home").classList.remove('current');
        document.getElementById("networks").classList.remove('current');
         document.getElementById("discussions").classList.remove('current');
         document.getElementById("userprofile").classList.remove('current');
         document.getElementById("createnetwork").classList.add('current');
    }