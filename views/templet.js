function unwrap(wrapper) {
    var docFrag = document.createDocumentFragment();
    while (wrapper.firstChild) {
            var child = wrapper.removeChild(wrapper.firstChild);
            docFrag.appendChild(child);
    }
    wrapper.parentNode.replaceChild(docFrag, wrapper);
}
function pageScroll() {
    window.scrollBy(0,50);
    scrolldelay = setTimeout(pageScroll,10);
}

const resendQuery = (function(statement,use=0){
    let newXML = new XMLHttpRequest();
    newXML.open('GET',statement,true);
    
    newXML.onreadystatechange = function(){
        if(this.status == 200 && this.readyState == 4){
            if(use === 1){
                    jsonMessage = JSON.parse(this.responseText);
                    displayErrorChange(jsonMessage)                                            
            }
            if(use === 2){
                    childs = document.createElement('div');
                    childs.classList.add('removableDiv');
                    childs.innerHTML =  this.responseText;
                    parent = document.querySelector('.parent');
                    parent.appendChild(childs);
                    unwrap(document.querySelector('.removableDiv'));
            }
            if(use === 3)
                window.location.href = this.responseText;
            if(use === 4){
                let content = document.querySelector('.errorContainer');
                jsonMessage = JSON.parse(this.responseText);
                if(jsonMessage['valid'])
                    content.innerHTML = "<div class='error valide'>"+jsonMessage['valid']+"</div>";
                else
                    content.innerHTML = "<div class='error'>"+jsonMessage['error']+"</div>";
                content.children[0].style.opacity = 1;
                setTimeout(function(){ content.children[0].style.opacity = 0; }, 5000)
            }
        }
    }
    newXML.send();   
});

function changeLikeIcon(e) {
    track = e.src.split('/');
    likeNumber = parseInt(e.parentNode.children[1].innerHTML, 10);
    if (track.includes('full-heart.svg')) {
        e.parentNode.children[1].innerHTML = (likeNumber - 1);
        e.src = "../imgs/heart.svg";
    } else if (track.includes('heart.svg')) {
        e.parentNode.children[1].innerHTML = (likeNumber + 1);
        e.src = "../imgs/full-heart.svg";
    }
}

function hidePic(e) {
    let containUpload = document.querySelector('#containUpload');
    let thePic = document.querySelector('.thePic');
    let takePic = document.querySelector('.takePic');
    thePic.style.display = "none";
    takePic.style.display = "block";
    containUpload.style.display = "block";
}
function infiniteloading(e){
    dead = false
    let scrollSave = e;
    let scrollable = document.documentElement.scrollHeight - window.innerHeight;
    let scrolled = window.scrollY;
    if(Math.ceil(scrolled) === scrollable){
            if(dead == false){
                    dead = true;
                    index = document.querySelectorAll('.post').length;
                    let spinner = document.querySelector('.spinner');
                    spinner.style.display ='block';
                    let statement = "../function/CreateHTMLPost.php?use=reload&index="+index;  
                    setTimeout(function(){resendQuery(statement,2);}, 2000);
                    setTimeout(function(){spinner.style.display ='none'}, 3000);
                    setTimeout(function(){dead = false}, 4000); 
                    if(scrollable > scrollSave){
                            index = document.querySelectorAll('.post').length;
                            scrollSave = scrollable;   
                    }
            }
    } 
}
function deletePublication(e) {
    let scrollSave = 0;
    let focus = document.querySelector('.focus');
    let choice = document.querySelector('.confirmation');
    let canceled = document.querySelector('.cancel');
    var deleted = document.querySelector('.delete');
    var deleted_icon = e;
    let actual = deleted_icon.parentNode.parentNode.parentNode.parentNode.parentNode;
    focus.style.display = "block";
    choice.style.display = "block";
    choice.firstChild.children[1].firstChild.innerHTML = actual.firstChild.innerHTML;
    canceled.addEventListener("click", function (e) {
        focus.style.display = "none";
        choice.style.display = "none";
    });
    deleted.addEventListener("click", function (e) {
        if(actual.parentNode){
            actual.parentNode.removeChild(actual);
            focus.style.display = "none";
            choice.style.display = "none";
            infiniteloading(scrollSave);           
        }
    })
}
function blockUser(e) {
    let scrollSave = 0;
    var objDiv = document.querySelector(".parent");
    let focus = document.querySelector('.focus');
    let choice = document.querySelector('.confirmation1');
    let canceled = document.querySelector('.cancel1');
    var deleted = document.querySelector('.delete1');
    var deleted_icon = e;
    let actual = deleted_icon.parentNode.parentNode.parentNode.parentNode.parentNode;
    focus.style.display = "block";
    choice.style.display = "block";
    choice.firstChild.children[1].firstChild.innerHTML = actual.firstChild.innerHTML;
    canceled.addEventListener("click", function (e) {
        focus.style.display = "none";
        choice.style.display = "none";
    });
    objDiv.scrollTop = objDiv.scrollHeight;
}

function addComment(e,comment) {
    let userName = e.parentNode.children[0].children[1].innerHTML;
    let userProfile = e.parentNode.children[0].children[0].src;
    let commentRoot = e.parentNode.parentNode.parentNode.parentNode.querySelector(".comment");
    let newComment, wrapperImage, wrapperText, profile, mignature, name, quote;
    newComment = document.createElement('div');
    name = document.createElement('div');
    quote = document.createElement('div');
    profile = document.createElement('div');
    wrapperText = document.createElement('div');
    wrapperImage = document.createElement('div');
    mignature = document.createElement('img');
    row = document.createElement('div');
    newComment.className = 'singleComment';
    wrapperText.className = 'col-sm-12';
    wrapperImage.className = 'no-padding';
    wrapperImage.classList.add("col-sm-12");
    profile.className = 'profile';
    mignature.className = 'mignature';
    quote.className = 'quote';
    name.className = 'name';
    row.className = 'row';
    mignature.src = userProfile;
    quote.innerHTML = comment;
    name.innerHTML = userName;
    profile.appendChild(mignature);
    profile.appendChild(name);
    wrapperImage.appendChild(profile);
    wrapperText.appendChild(quote);
    row.appendChild(wrapperImage);
    row.appendChild(wrapperText);
    newComment.appendChild(row);
    commentRoot.prepend(newComment);
    e.value = '';
}

function switchCase(){
    loginResposive();
    let switchCase = document.querySelector('.switch');
    let hider = document.querySelector('.hider');
    let errorRegister = document.querySelector('.errorRegister');
    let errorLogin = document.querySelector('.errorLogin');
    if(switchCase.innerHTML === "already have an account ? <span>Sign in</span>"){
        errorLogin.style.display = 'block';
        switchCase.innerHTML = "New to CAMAGRU ? <span>Sign up</span>";
        hider.className += " hiderLeft";
        errorRegister.style.display = 'none';
    }
    else if(switchCase.innerHTML === "New to CAMAGRU ? <span>Sign up</span>"){
        errorRegister.style.display = 'block';
        switchCase.innerHTML = "already have an account ? <span>Sign in</span>";
        hider.classList.remove("hiderLeft");
        errorLogin.style.display = 'none';
    }
}
function clearSwitch1(e){
    let errorRegister = document.querySelector('.errorRegister');
    let errorLogin = document.querySelector('.errorLogin');
    let login = document.querySelector(".login");
    let registration = document.querySelector(".registration");
    login.style.display = 'block';
    registration.style.display = 'none';
    errorRegister.style.display = 'none';
    errorLogin.style.display = 'block';
}
function clearSwitch2(e){
    let errorLogin = document.querySelector('.errorLogin');
    let errorRegister = document.querySelector('.errorRegister');
    let login = document.querySelector(".login");
    let registration = document.querySelector(".registration");
    login.style.display = 'none';
    errorLogin.style.display = 'none';
    errorRegister.style.display = 'block';
    registration.style.display = 'block';
}
function loginResposive(){
    let login = document.querySelector(".login");
    let registration = document.querySelector(".registration");
    let winWidth = window.innerWidth;
    let hideContain = document.querySelector(".hideContain");
    let clearSwitch = document.querySelectorAll(".clearSwitch");
    if(winWidth <= 766){
            clearSwitch[0].style.display = 'block';
            clearSwitch[1].style.display = 'block';
            hideContain.style.display = 'none';
            login.style.display = 'none';
            let leftError = document.querySelector('#loginError');
            if(typeof(leftError) != 'undefined' && leftError != null){
                login.style.display = 'block';
                registration.style.display = 'none';
            }
    }

    else{
            login.style.display = 'block';
            registration.style.display = 'block';
            hideContain.style.display = 'block';
            clearSwitch[0].style.display = 'none';
            clearSwitch[1].style.display = 'none';
    }
}

function displayImage(e) {
    if (e.files[0]){
        var reader = new FileReader();
        reader.onload = function (e) {
            document.querySelector('.edit').style.backgroundImage = "url('" + e.target.result + "')";
        }
        reader.readAsDataURL(e.files[0]);
    }
}

function chooseProfile() {
    inputTrigger = document.querySelector('#profileUpload');
    inputTrigger.click();
}

function inputClick(e) {
    e.children[0].focus();
    e.style.boxShadow = "0 0 0.2rem rgba(173, 173, 173, 0.2)";
}
function submitImage(){
    inputTrigger = document.querySelector('#uploadImage');
    inputTrigger.submit();
}
function inputInfocus(e) {
    e.parentElement.style.boxShadow = "none";
}

function copyLink(e){
    let idPost = e.parentNode.parentNode.parentNode.firstChild.innerHTML;
    let input = document.querySelector('.copyField');
    let copiedLink = e.nextSibling;
    input.style.display = 'block';
    input.value = "views/viewSinglePost.php?id=" + idPost;
    input.select();
    document.execCommand("Copy");
    input.setSelectionRange(0, 99999);
    copiedLink.style.opacity = 1;
    setTimeout(function(){copiedLink.style.opacity = 0;},3000)
    
}

function emailResend(e){
    e.preventDefault();
    let email = document.querySelector('.emailRessend').value;
    let statement = "../function/passwordMail.php?ressendPassword=1&email="+email;
    resendQuery(statement,4);
}

function passwordResend(e){
    e.preventDefault();
    let passwordAll = document.querySelectorAll('.passwordResend');
    let password = passwordAll[0].value;
    let confirmPassword = passwordAll[1].value;
    let token = document.querySelector('#token').value;
    let email = document.querySelector('#email').value;
    let statement = "../function/changePassword.php?resetPassword=1&password="+password+"&confirmPassword="+confirmPassword+"&token="+token+"&email="+email;
    resendQuery(statement,4);
}
function displayChange(){
    let focus = document.querySelector('.focus');
    let changeCard = document.querySelector('.changeCard');
    focus.style.display = 'block';
    changeCard.style.opacity = 1;
    changeCard.style.display = 'block';
    focus.addEventListener("click",function(){
            changeCard.style.opacity = 0; 
            focus.style.display = 'none';
            location.reload(); 
    })
}
function addCommentQuery(e){
    document.addEventListener("keypress", function (event) {
    if (event.keyCode == 13) {
        let comment1 = e.value.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;').trim();
        let comment2 = e.value.trim();
        if (comment1 != '') {
            let postID = e.parentNode.parentNode.parentNode.parentNode.firstChild.innerHTML;
            let statement = "../function/postInteraction.php?use=comment&comment="+comment2+"&postID="+postID; 
            resendQuery(statement);
            addComment(e,comment1);   
        }
    }
});
}

function blockQuery(e){
    let postID = e.parentNode.firstChild.innerHTML;
    let statement = "../function/postInteraction.php?use=block&postID="+postID;
    resendQuery(statement);
    location.reload(true);
}

function deletePostQuery(e){
    let postID = e.parentNode.firstChild.innerHTML;
    let statement = "../function/postInteraction.php?use=delete&postID="+postID;
    resendQuery(statement);
}

function likesQuery(e){
    changeLikeIcon(e);
    let postID = e.parentNode.parentNode.parentNode.firstChild.innerHTML;
    let statement = "../function/postInteraction.php?use=like&postID="+postID;
    resendQuery(statement);
}

function submitChanges(e){
    let pseudo = document.querySelector('#changeUser').value;
    let email = document.querySelector('#changeEmail').value;
    let password = document.querySelector('#changePassword').value;
    let confirmPassword = document.querySelector('#confirmPassword').value;
    let notif = document.querySelector('#changeNotif').checked;
    let statement = "../function/changeInfoAjax.php?changeUser="+pseudo+"&changeEmail="+email+"&changePassword="+password+"&confirmChangePassword="+confirmPassword+"&changeNotif="+notif;
    resendQuery(statement,1);
}

function disconnect(){
    let statement = '../function/logout.php';
    resendQuery(statement,3);
}

function displayErrorChange(jsonMessage){
    let emailMsg,pseudoMsg,passwordMsg;
    let father = document.querySelector('.errorContainer');
    if(jsonMessage['notification']){
        notifMsg = document.createElement('div');
        notifMsg.className = 'error';
        notifMsg.classList.add('valide');
        notifMsg.style.opacity = 1;
        notifMsg.innerHTML = jsonMessage['notification'];
        setTimeout(function(){notifMsg.style.opacity = 0;}, 3000);
        setTimeout(function(){notifMsg.style.display = 'none';},5000);
        father.appendChild(notifMsg);
    }
    if(jsonMessage['email']){
            emailMsg = document.createElement('div');
            emailMsg.className = 'error';
            emailMsg.style.display = 'block';
            if(jsonMessage['email'] != 'Your email have been updated'){
                  emailMsg.innerHTML = jsonMessage['email'];
                  document.querySelector('#changeEmail').classList.add('errorField');
                  setTimeout(function(){emailMsg.style.display = 'none';},3000);
            }
                    
            else{
                    let newEmail = document.querySelector('#changeEmail');
                    newEmail.placeholder = newEmail.value;
                    if(newEmail.classList.contains('errorField'))
                        newEmail.value = '';
                    newEmail.classList.remove('errorField');
                    emailMsg.innerHTML = jsonMessage['email'];
                    emailMsg.classList.add('valide');
                    emailMsg.style.opacity = 1;
                    setTimeout(function(){emailMsg.style.opacity = 0;}, 3000);
                    setTimeout(function(){emailMsg.style.display = 'none';},5000);
            }
            father.appendChild(emailMsg)
    }
    if(jsonMessage['pseudo']){
            pseudoMsg = document.createElement('div');
            pseudoMsg.className = 'error';
            pseudoMsg.style.className = 'error';
            if(jsonMessage['pseudo'] != 'Your pseudo have been updated'){
                    pseudoMsg.innerHTML = jsonMessage['pseudo'];
                    document.querySelector('#changeUser').classList.add('errorField');
                    setTimeout(function(){pseudoMsg.style.display = 'none' ;},3000);
            }
                    
            else{
                    let newPseudo = document.querySelector('#changeUser');
                    newPseudo.placeholder = newPseudo.value;
                    newPseudo.value = '';
                    if(newPseudo.classList.contains('errorField'))
                        newPseudo.classList.remove('errorField');
                    pseudoMsg.innerHTML = jsonMessage['pseudo'];
                    pseudoMsg.classList.add('valide');
                    pseudoMsg.style.opacity = 1;
                    setTimeout(function(){pseudoMsg.style.opacity = 0;
                    }, 3000);
                    setTimeout(function(){pseudoMsg.style.display = 'none' ;},5000);
            }
            father.appendChild(pseudoMsg)
    }
    if(jsonMessage['password']){
            passwordMsg = document.createElement('div');
            passwordMsg.className = 'error'; 
            passwordMsg.style.display = 'block';
            let confirmPassword = document.querySelector('#confirmPassword');
            let changePassword = document.querySelector('#changePassword');
            if(jsonMessage['password'] != 'Your password have been updated'){
                 passwordMsg.innerHTML = jsonMessage['password'];
                 document.querySelector('#changePassword').classList.add('errorField');
                 confirmPassword.value = '';
                 setTimeout(function(){passwordMsg.style.display = 'none' ;},3000);
            }
                    
            else{
                    if(changePassword.classList.contains('errorField'))
                        changePassword.classList.remove('errorField');
                    changePassword.value = '';
                    confirmPassword.value = '';
                    passwordMsg.innerHTML = jsonMessage['password'];
                    passwordMsg.classList.add('valide');
                    passwordMsg.style.opacity = 1;
                    setTimeout(function(){passwordMsg.style.opacity = 0;
                   }, 3000);
                   setTimeout(function(){pseudo.Msgstyle.display = 'none';},5000);
                   
            }
            father.appendChild(passwordMsg);
    }
}

function saveThePic(e){
    let canvas = document.querySelector('#canvas');
    let canvaUrl = canvas.toDataURL();
    let hiddenInput = document.querySelector('.encodedCanva');
    hiddenInput.value = canvaUrl;
}

function bindImages(e){
    e.preventDefault();
    let stickers = document.getElementsByName('sticker');
    let stickerValue = 0;
    let imageEncoded = document.querySelector('.encodedCanva').value;
    let i = -1;
    while(stickers[++i]){
            if(stickers[i].checked){
                    stickerValue = stickers[i].value;
                    break ;
            }
    }
    let statement = "../function/createImage.php?encodedCanva="+imageEncoded+"&sticker="+stickerValue;
    resendQuery(statement,0);
}

function delcomment(e){
    let commentID = e.children[0].innerHTML;
    let comment = e.parentNode.parentNode.parentNode.parentNode;
    comment.style.display = 'none';
    let statement = "../function/postInteraction.php?use=commentDel&commentID="+commentID;
    resendQuery(statement);
}