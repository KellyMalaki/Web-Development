function home(){
    document.getElementById("home").classList.add('current');
    document.getElementById("login").classList.remove('current');
    document.getElementById("signin").classList.remove('current');
    document.getElementById("network").classList.remove('current');
    }
    function login(){
         document.getElementById("home").classList.remove('current');
         document.getElementById("signin").classList.remove('current');
         document.getElementById("network").classList.remove('current');
        document.getElementById("login").classList.add('current');
    }
    function signin(){
        document.getElementById("signin").classList.add('current');
        document.getElementById("home").classList.remove('current');
         document.getElementById("login").classList.remove('current');
         document.getElementById("network").classList.remove('current');
    }