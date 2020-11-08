class Comment {
    constructor(id, pet, user, userPictureUrl, postedOn, text, commentPictureUrl, parent){
        this.id = id;
        this.pet = pet;
        this.user = user;
        this.userPictureUrl = userPictureUrl;
        this.postedOn = postedOn;
        this.text = text;
        this.commentPictureUrl = commentPictureUrl;
        this.parent = parent;
        this.children = [];
    }
    addChild(childId){
        this.children.push(childId);
    }
    sortChildren(){
        this.children.sort(Comment.compare);
    }
    static compare(lhs, rhs){
        if     (lhs.pet      !== rhs.pet     ) return (lhs.pet      < rhs.pet      ? -1 : 1);
        else if(lhs.postedOn !== rhs.postedOn) return (lhs.postedOn > rhs.postedOn ? -1 : 1);
        else if(lhs.user     !== rhs.user    ) return (lhs.user     < rhs.user     ? -1 : 1);
        else if(lhs.id       !== rhs.id      ) return (lhs.id       < rhs.id       ? -1 : 1);
        else if(lhs.parent   !== rhs.parent  ) return (lhs.parent   < rhs.parent   ? -1 : 1);
        else if(lhs.text     !== rhs.text    ) return (lhs.text     < rhs.text     ? -1 : 1);
        else                                   return 0;
    }
    createElement(){
        let commentElement = cloneNodeRecursive(document.querySelector("#templates>#comment"));
        commentElement.id = `comment-${this.id}`;
        
        let el_user = commentElement.querySelector("#comment-user");
        el_user.children[0].href = `profile.php?username=${this.user}`;
        el_user.children[0].innerHTML = this.user;
        
        let el_pic = commentElement.querySelector("#comment-profile-pic-a");
        el_pic.href=`profile.php?username=${this.user}`;
        el_pic.children[0].src = this.userPictureUrl;
    
        let el_date = commentElement.querySelector("#comment-date"); el_date.innerHTML = this.postedOn;
        let el_text = commentElement.querySelector("#comment-text"); el_text.innerHTML = this.text;
        if(el_text.innerHTML === '') el_text.style.display = "none";
        let el_img  = commentElement.querySelector("#comment-picture"); el_img.src = this.commentPictureUrl;
    
        return commentElement;
    }
    /**
     * @brief Create answer element.
     * 
     * @param {User} user User that is answering
     */
    createAnswerElement(user){
        let answerElement = cloneNodeRecursive(document.querySelector("#templates>#new-comment"));
        answerElement.id = `new-comment-${this.id}`;
    
        let el_answerTo = answerElement.querySelector('#comment-answerTo');
        el_answerTo.value = this.id;
    
        let el_user = answerElement.querySelector("#comment-user");
        el_user.children[0].href = `profile.php?username=${user.username}`;
        el_user.children[0].innerHTML = user.username;
        
        let el_pic = answerElement.querySelector("#comment-profile-pic-a");
        el_pic.href=`profile.php?username=${user.username}`;
        el_pic.children[0].src = user.pictureUrl;
    
        return answerElement;
    }
    createEditElement(commentElement){
        let userElement       = commentElement.querySelector('#comment-user');
        let userImgElement    = commentElement.querySelector('#comment-profile-pic-a');
        let textElement       = commentElement.querySelector('#comment-text');
        let commentImgElement = commentElement.querySelector('#comment-picture');
    
        let editElement = cloneNodeRecursive(document.querySelector("#templates>#edit-comment"));
        editElement.id = `edit-comment-${this.id}`;
    
        let el_commentId = editElement.querySelector('#commentId');
        el_commentId.value = this.id;
    
        let el_user = editElement.querySelector("#comment-user");
        el_user.children[0].href = userElement.children[0].href;
        el_user.children[0].innerHTML = userElement.children[0].innerHTML;
    
        let el_userPic = editElement.querySelector("#comment-profile-pic-a");
        el_userPic.href=userImgElement.href;
        el_userPic.children[0].src = userImgElement.children[0].src;
    
        let el_text = editElement.querySelector("#comment-text");
        el_text.value = textElement.innerHTML;
    
        let el_img = editElement.querySelector("#comment-picture");
        el_img.src = commentImgElement.attributes.src.value;
    
        return editElement;
    }
}
