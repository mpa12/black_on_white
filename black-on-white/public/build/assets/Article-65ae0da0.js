import{_ as C,U as l,f as u,r as _,o as m,c,a as s,t as h,i as d,k as y,l as b,m as k,F as g,g as v,h as R,p as x,d as A,b as f}from"./app-f65f30b7.js";import{c as D}from"./ChangeDate-db5be761.js";import"./_commonjsHelpers-87174ba5.js";const I={name:"Comment",props:["comment","comments"],data(){return{canComment:!1,canDeleteComment:!1,childComments:null,parentComments:[],errors:[],replying:!1,isDeleted:!1,body:null}},mounted(){this.getChildComment(),this.checkCanComment(),this.checkCanDeleteComment()},methods:{changeDate:D,checkCanComment(){this.canComment=l.isAuth()},checkCanDeleteComment(){this.canDeleteComment=this.comment.can_delete},getChildComment(){const t=e=>e.parent_id===this.comment.id;this.childComments=this.comments.filter(t)},showReplyForm(){this.replying=!0},hideReplyForm(){this.replying=!1},reply(){let t=new FormData;t.append("body",this.body),t.append("article_id",this.$route.params.id),t.append("parent_id",this.comment.id);const e="/api/comment",r={headers:{"Content-Type":"multipart/form-data",Authorization:l.getAuthorizationString()}};u.post(e,t,r).then(a=>{this.errors=[],this.body=null,this.childComments.push(a.data.success)}).catch(a=>{if(a.response.status!==422)return;this.errors=[];let n=JSON.parse(a.request.responseText).errors;for(const o in n)this.errors[o]=n[o][0]})},deleteComment(t){const e="/api/comment/"+t,r={_method:"delete"},a={headers:{"Content-Type":"multipart/form-data",Authorization:l.getAuthorizationString()}};u.post(e,r,a).then(()=>{this.isDeleted=!0}).catch(console.error)}}},S=t=>(x("data-v-e6e7b3ad"),t=t(),A(),t),z={key:0,class:"comment mt-2"},F={class:"d-flex gap-2 align-items-baseline"},T={class:"m-0"},N={class:"m-0"},V={class:"flex-grow-1"},B=S(()=>s("label",{class:"form-label"},"Ответ",-1)),H={class:"d-flex flex-column justify-content-between align-items-end"},M=S(()=>s("button",{class:"btn btn-dark"},"Отправить",-1));function U(t,e,r,a,n,o){const p=_("comment",!0);return m(),c(g,null,[n.isDeleted?d("",!0):(m(),c("section",z,[s("div",F,[s("h6",T,h(r.comment.user.name),1),s("time",null,h(o.changeDate(r.comment.created_at)),1)]),s("p",N,h(r.comment.body),1),n.canComment?(m(),c("button",{key:0,type:"button",class:"reply-button",onClick:e[0]||(e[0]=(...i)=>o.showReplyForm&&o.showReplyForm(...i))})):d("",!0),n.canDeleteComment?(m(),c("button",{key:1,type:"button",class:"delete-button",onClick:e[1]||(e[1]=i=>o.deleteComment(r.comment.id))})):d("",!0),n.replying?(m(),c("form",{key:2,class:"d-flex gap-2",onSubmit:e[4]||(e[4]=y((...i)=>o.reply&&o.reply(...i),["prevent"]))},[s("div",V,[B,b(s("input",{"onUpdate:modelValue":e[2]||(e[2]=i=>n.body=i),type:"text",class:"form-control"},null,512),[[k,n.body]])]),s("div",H,[s("button",{class:"reply-cancel",type:"button",onClick:e[3]||(e[3]=(...i)=>o.hideReplyForm&&o.hideReplyForm(...i))},"отмена"),M])],32)):d("",!0)])),s("div",null,[n.childComments?(m(!0),c(g,{key:0},v(n.childComments,i=>(m(),R(p,{comment:i,comments:r.comments},null,8,["comment","comments"]))),256)):d("",!0)])],64)}const L=C(I,[["render",U],["__scopeId","data-v-e6e7b3ad"]]);const P={name:"Comments",components:{Comment:L},props:["article_id"],data(){return{canComment:!1,hasComments:!1,comments:[],parentComments:[],body:null,errors:[]}},mounted(){this.loadComments()},methods:{checkCanComment(){this.canComment=l.isAuth()},checkHasComments(){this.hasComments=!!this.comments},getParentComments(){this.parentComments=this.comments.filter(t=>t.parent_id===null)},loadComments(){const t=`/api/comment/${this.article_id}`,e={headers:{Authorization:l.getAuthorizationString()}};u.get(t,e).then(r=>{this.comments=r.data.data,this.checkCanComment(),this.checkHasComments(),this.getParentComments()})},createComment(){let t=new FormData;t.append("body",this.body),t.append("article_id",this.article_id);const e="/api/comment",r={headers:{"Content-Type":"multipart/form-data",Authorization:l.getAuthorizationString()}};u.post(e,t,r).then(a=>{this.errors=[],this.body=null,this.comments.push(a.data.success),this.getParentComments()}).catch(a=>{if(a.response.status!==422)return;this.errors=[];let n=JSON.parse(a.request.responseText).errors;for(const o in n)this.errors[o]=n[o][0]})}}},w=t=>(x("data-v-6e171bc3"),t=t(),A(),t),q={key:0,class:"comments-section mt-3"},J={class:"flex-grow-1"},O=w(()=>s("label",{class:"form-label"},"Комментарий",-1)),j=w(()=>s("button",{class:"btn btn-dark"},"Отправить",-1)),E={key:1,class:"alert alert-light text-center"};function G(t,e,r,a,n,o){const p=_("comment");return n.canComment||n.hasComments?(m(),c("section",q,[n.canComment?(m(),c("form",{key:0,class:"d-flex align-items-end gap-2",onSubmit:e[1]||(e[1]=y((...i)=>o.createComment&&o.createComment(...i),["prevent"]))},[s("div",J,[O,b(s("input",{type:"text",class:"form-control","onUpdate:modelValue":e[0]||(e[0]=i=>n.body=i)},null,512),[[k,n.body]])]),j],32)):d("",!0),n.hasComments?d("",!0):(m(),c("p",E,"Нет комментариев")),(m(!0),c(g,null,v(n.parentComments,i=>(m(),R(p,{comment:i,comments:n.comments},null,8,["comment","comments"]))),256))])):d("",!0)}const $=C(P,[["render",G],["__scopeId","data-v-6e171bc3"]]);const K={name:"ArticleRating",props:["articleId"],data(){return{rating:0,isRated:!1}},mounted(){this.getRating(this.articleId)},methods:{getRating(t){u.get(`/api/rating/${t}`,{headers:{Authorization:l.getAuthorizationString()}}).then(this.setRating).catch(console.error)},getImageSrc(t){return t?"/images/heart-fill.svg":"/images/heart.svg"},getImageAlt(t){return t?"Понравилось":"Лайкнуть"},updateRating(t){if(l.isGuest())return;this.rating+=this.isRated?-1:1,this.isRated=!this.isRated;let e=new FormData;e.append("create_rating",this.isRated?1:0),e.append("article_id",t),u.post("/api/rating",e,{headers:{"Content-Type":"multipart/form-data",Authorization:l.getAuthorizationString()}}).then(this.setRating).catch(console.error)},setRating(t){this.rating=t.data.rating,this.isRated=t.data.isRated}}},Q={class:"w-100 section mt-3"},W=["src","alt"];function X(t,e,r,a,n,o){return m(),c("section",Q,[s("span",{role:"button",class:"me-2",onClick:e[0]||(e[0]=p=>o.updateRating(this.articleId))},[s("img",{src:o.getImageSrc(n.isRated),alt:o.getImageAlt(n.isRated)},null,8,W)]),s("span",null,h(n.rating),1)])}const Y=C(K,[["render",X],["__scopeId","data-v-7616f0a0"]]);const Z={name:"Article",components:{ArticleRating:Y,Comments:$},data(){return{article:[]}},mounted(){this.loadArticle()},methods:{changeDate:D,loadArticle(){const t="/api/article/"+this.$route.params.id;u.get(t).then(e=>{this.article=e.data.data})}}},tt={class:"article-main"},et={class:"mb-2"},nt={class:"fw-lighter"},st=s("br",null,null,-1),ot={class:"mt-2"},it=["src","alt"],rt=["innerHTML"];function at(t,e,r,a,n,o){const p=_("article-rating"),i=_("comments");return m(),c(g,null,[s("section",tt,[s("h3",et,h(n.article.title),1),s("span",nt,h(o.changeDate(n.article.created_at)),1),st,s("p",ot,h(n.article.description),1),s("img",{src:"/storage/"+n.article.photo,alt:n.article.title,class:"my-2 mx-auto d-block article-main-img"},null,8,it),s("section",{class:"mt-2 content",innerHTML:n.article.text},null,8,rt)]),f(p,{"article-id":t.$route.params.id},null,8,["article-id"]),f(i,{article_id:t.$route.params.id},null,8,["article_id"])],64)}const dt=C(Z,[["render",at]]);export{dt as default};
