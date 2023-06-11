import{_ as f,f as _,r as p,o as m,c as l,a as o,t as h,i as d,k as y,l as b,m as A,F as g,g as k,h as R,p as P,d as U,b as C}from"./app-51fe443e.js";import{m as c}from"./moment-with-locales-723ca905.js";import"./_commonjsHelpers-87174ba5.js";const x={name:"Comment",props:["comment","comments"],data(){return{canComment:!1,canDeleteComment:!1,childComments:null,parentComments:[],errors:[],replying:!1,isDeleted:!1,body:null}},mounted(){this.getChildComment(),this.checkCanComment(),this.checkCanDeleteComment()},methods:{checkCanComment(){this.canComment=!!localStorage.getItem("token")},checkCanDeleteComment(){this.canDeleteComment=this.comment.can_delete},getChildComment(){this.childComments=this.comments.filter(t=>t.parent_id===this.comment.id)},changeCreatedAt(t){t=new Date(t);const e=c.duration(c().diff(t));if(e.asMinutes()<60){let s=new Date().getTime()-t.getTime();return s=new Date(s).getMinutes(),s+" минут назад"}else return e.asHours()<24?c().subtract(e).format("HH часов назад"):e.asDays()<2?c().subtract(e).format("Вчера в HH:mm"):(c.locale("ru"),c(t).format("D MMMM в HH:mm YYYY"))},showReplyForm(){this.replying=!0},hideReplyForm(){this.replying=!1},reply(){let t=new FormData;t.append("body",this.body),t.append("article_id",this.$route.params.id),t.append("parent_id",this.comment.id),_.post("http://localhost:8080/api/comment",t,{headers:{"Content-Type":"multipart/form-data",Authorization:`Bearer ${localStorage.getItem("token")}`}}).then(e=>{this.errors=[],this.body=null,this.childComments.push(e.data.success)}).catch(e=>{if(e.response.status===422){this.errors=[];let s=JSON.parse(e.request.responseText).errors;for(const i in s)this.errors[i]=s[i][0]}})},deleteComment(t){_.delete("http://localhost:8080/api/comment/"+t,{headers:{"Content-Type":"multipart/form-data",Authorization:`Bearer ${localStorage.getItem("token")}`}}).then(()=>{this.isDeleted=!0}).catch(e=>{console.log(e)})}}},v=t=>(P("data-v-123b5465"),t=t(),U(),t),I={key:0,class:"comment mt-2"},w={class:"d-flex gap-2 align-items-baseline"},S={class:"m-0"},V={class:"m-0"},H={class:"flex-grow-1"},L=v(()=>o("label",{class:"form-label"},"Ответ",-1)),M={class:"d-flex flex-column justify-content-between align-items-end"},E=v(()=>o("button",{class:"btn btn-dark"},"Отправить",-1));function T(t,e,s,i,n,r){const u=p("comment",!0);return m(),l(g,null,[n.isDeleted?d("",!0):(m(),l("section",I,[o("div",w,[o("h6",S,h(s.comment.user.name),1),o("time",null,h(r.changeCreatedAt(s.comment.created_at)),1)]),o("p",V,h(s.comment.body),1),n.canComment?(m(),l("button",{key:0,type:"button",class:"reply-button",onClick:e[0]||(e[0]=(...a)=>r.showReplyForm&&r.showReplyForm(...a))})):d("",!0),n.canDeleteComment?(m(),l("button",{key:1,type:"button",class:"delete-button",onClick:e[1]||(e[1]=a=>r.deleteComment(s.comment.id))})):d("",!0),n.replying?(m(),l("form",{key:2,class:"d-flex gap-2",onSubmit:e[4]||(e[4]=y((...a)=>r.reply&&r.reply(...a),["prevent"]))},[o("div",H,[L,b(o("input",{"onUpdate:modelValue":e[2]||(e[2]=a=>n.body=a),type:"text",class:"form-control"},null,512),[[A,n.body]])]),o("div",M,[o("button",{class:"reply-cancel",type:"button",onClick:e[3]||(e[3]=(...a)=>r.hideReplyForm&&r.hideReplyForm(...a))},"отмена"),E])],32)):d("",!0)])),o("div",null,[n.childComments?(m(!0),l(g,{key:0},k(n.childComments,a=>(m(),R(u,{comment:a,comments:s.comments},null,8,["comment","comments"]))),256)):d("",!0)])],64)}const F=f(x,[["render",T],["__scopeId","data-v-123b5465"]]);const B={name:"Comments",components:{Comment:F},props:["article_id"],data(){return{canComment:!1,hasComments:!1,comments:[],parentComments:[],body:null,errors:[]}},mounted(){this.loadComments()},methods:{checkCanComment(){this.canComment=!!localStorage.getItem("token")},checkHasComments(){this.hasComments=!!this.comments},getParentComments(){this.parentComments=this.comments.filter(t=>t.parent_id===null)},loadComments(){_.get(`http://localhost:8080/api/comment/${this.article_id}`,{headers:{Authorization:`Bearer ${localStorage.getItem("token")}`}}).then(t=>{this.comments=t.data.data,this.checkCanComment(),this.checkHasComments(),this.getParentComments()})},createComment(){let t=new FormData;t.append("body",this.body),t.append("article_id",this.article_id),_.post("http://localhost:8080/api/comment",t,{headers:{"Content-Type":"multipart/form-data",Authorization:`Bearer ${localStorage.getItem("token")}`}}).then(e=>{this.errors=[],this.body=null,this.comments.push(e.data.success),this.getParentComments()}).catch(e=>{if(e.response.status===422){this.errors=[];let s=JSON.parse(e.request.responseText).errors;for(const i in s)this.errors[i]=s[i][0]}})}}},D=t=>(P("data-v-b20c408c"),t=t(),U(),t),Y={key:0,class:"comments-section mt-3"},$={class:"flex-grow-1"},z=D(()=>o("label",{class:"form-label"},"Комментарий",-1)),N=D(()=>o("button",{class:"btn btn-dark"},"Отправить",-1)),q={key:1,class:"alert alert-light text-center"};function J(t,e,s,i,n,r){const u=p("comment");return n.canComment||n.hasComments?(m(),l("section",Y,[n.canComment?(m(),l("form",{key:0,class:"d-flex align-items-end gap-2",onSubmit:e[1]||(e[1]=y((...a)=>r.createComment&&r.createComment(...a),["prevent"]))},[o("div",$,[z,b(o("input",{type:"text",class:"form-control","onUpdate:modelValue":e[0]||(e[0]=a=>n.body=a)},null,512),[[A,n.body]])]),N],32)):d("",!0),n.hasComments?d("",!0):(m(),l("p",q,"Нет комментариев")),(m(!0),l(g,null,k(n.parentComments,a=>(m(),R(u,{comment:a,comments:n.comments},null,8,["comment","comments"]))),256))])):d("",!0)}const O=f(B,[["render",J],["__scopeId","data-v-b20c408c"]]);const j={name:"ArticleRating",props:["articleId"],data(){return{rating:0,isRated:!1}},mounted(){this.getRating(this.articleId)},methods:{getRating(t){_.get(`http://localhost:8080/api/rating/${t}`,{headers:{Authorization:`Bearer ${localStorage.getItem("token")}`}}).then(e=>{this.rating=e.data.rating,this.isRated=e.data.isRated})},getImageSrc(t){return t?"/images/heart-fill.svg":"/images/heart.svg"},getImageAlt(t){return t?"Понравилось":"Лайкнуть"},updateRating(t){if(!localStorage.getItem("token"))return;this.rating+=this.isRated?-1:1,this.isRated=!this.isRated;let e=new FormData;e.append("create_rating",this.isRated?1:0),e.append("article_id",t),_.post("http://localhost:8080/api/rating",e,{headers:{"Content-Type":"multipart/form-data",Authorization:`Bearer ${localStorage.getItem("token")}`}}).then(s=>{console.log(s)}).catch(s=>{console.error(s)}),this.getRating(t)}}},G={class:"w-100 section mt-3"},K=["src","alt"];function Q(t,e,s,i,n,r){return m(),l("section",G,[o("span",{role:"button",class:"me-2",onClick:e[0]||(e[0]=u=>r.updateRating(this.articleId))},[o("img",{src:r.getImageSrc(n.isRated),alt:r.getImageAlt(n.isRated)},null,8,K)]),o("span",null,h(n.rating),1)])}const W=f(j,[["render",Q],["__scopeId","data-v-a5dd0077"]]);const X={name:"Article",components:{ArticleRating:W,Comments:O},data(){return{article:[],createdAt:""}},mounted(){this.loadArticle()},methods:{loadArticle(){_.get("http://localhost:8080/api/article/"+this.$route.params.id).then(t=>{this.article=t.data.data,this.changeCreatedAt(this.article.created_at)})},changeCreatedAt(t){const e=new Date(t);let s=c.duration(c().diff(e));if(s.asMinutes()<60){let i=new Date().getTime()-e.getTime();i=new Date(i).getMinutes(),this.createdAt=i+" минут назад"}else s.asHours()<24?this.createdAt=c().subtract(s).format("HH часов назад"):s.asDays()<2?this.createdAt=c().subtract(s).format("Вчера в HH:mm"):(c.locale("ru"),this.createdAt=c(e).format("D MMMM в HH:mm YYYY"))}}},Z={class:"article-main"},tt={class:"mb-2"},et={class:"fw-lighter"},st=o("br",null,null,-1),nt={class:"mt-2"},ot=["src","alt"],at=["innerHTML"];function rt(t,e,s,i,n,r){const u=p("article-rating"),a=p("comments");return m(),l(g,null,[o("section",Z,[o("h3",tt,h(n.article.title),1),o("span",et,h(n.createdAt),1),st,o("p",nt,h(n.article.description),1),o("img",{src:n.article.photo,alt:n.article.title,class:"my-2 mx-auto d-block article-main-img"},null,8,ot),o("section",{class:"mt-2 content",innerHTML:n.article.text},null,8,at)]),C(u,{"article-id":t.$route.params.id},null,8,["article-id"]),C(a,{article_id:t.$route.params.id},null,8,["article_id"])],64)}const ct=f(X,[["render",rt]]);export{ct as default};
