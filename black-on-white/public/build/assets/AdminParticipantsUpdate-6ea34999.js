import{T as P}from"./Toast-5fd08f16.js";import{_ as y,r as h,o as r,c as l,h as g,i as n,a as e,k as b,l as m,m as _,t as p,b as x,w as U,e as v,F as k,p as w,d as V}from"./app-b806d1ea.js";const A={name:"AdminParticipantsUpdate",components:{Toast:P},data(){return{errors:[],installedPhoto:null,name:null,role:null,photo:null,data:null,updated:!1}},mounted(){this.loadParticipant()},methods:{loadParticipant(){axios.get(`/api/participant/${this.$route.params.id}`,null,{headers:{"Content-Type":"multipart/form-data",Authorization:`Bearer ${localStorage.getItem("token")}`}}).then(t=>{this.name=t.data.data.name,this.role=t.data.data.role,this.installedPhoto=t.data.data.photo}).catch(t=>{console.log(t)})},handlePhotoUpload(){this.photo=this.$refs.files.files[0]},getData(){let t=new FormData;t.append("name",this.name),t.append("role",this.role),t.append("photo",this.photo),this.data=t},create(){this.getData(),axios.post(`/api/participant/${this.$route.params.id}`,this.data,{headers:{"Content-Type":"multipart/form-data",Authorization:`Bearer ${localStorage.getItem("token")}`}}).then(t=>{this.errors=[],this.name=t.data.success.name,this.role=t.data.success.role,this.photo=null,this.installedPhoto=t.data.success.photo,this.updated=!0}).catch(t=>{if(t.response.status===422){this.errors=[];let s=JSON.parse(t.request.responseText).errors;for(const c in s)this.errors[c]=s[c][0]}})}}},i=t=>(w("data-v-8aead463"),t=t(),V(),t),S=i(()=>e("div",{class:"title my-3"},[e("h1",null,"Редактирование участника")],-1)),T={class:"form-wrapper"},B={class:"mb-3"},C=i(()=>e("label",{for:"name",class:"form-label"},"ФИО участника",-1)),D={key:0,class:"text-danger"},I={class:"mb-3"},E=i(()=>e("label",{for:"role",class:"form-label"},"Роль участника",-1)),N={key:0,class:"text-danger"},L={class:"mb-3"},O={key:0,class:"w-100 d-flex align-items-center justify-content-center"},R=["src"],F=i(()=>e("label",{for:"photo",class:"form-label"},"Фото участника",-1)),z={key:1,class:"text-danger"},M={class:"d-flex gap-2"},j=i(()=>e("button",{type:"submit",class:"btn btn-primary"},"Сохранить",-1));function q(t,s,c,J,o,d){const u=h("toast"),f=h("router-link");return r(),l(k,null,[o.updated?(r(),g(u,{key:0,title:"Участник успешно изменен"})):n("",!0),S,e("div",T,[e("form",{onSubmit:s[3]||(s[3]=b((...a)=>d.create&&d.create(...a),["prevent"]))},[e("div",B,[C,m(e("input",{"onUpdate:modelValue":s[0]||(s[0]=a=>o.name=a),type:"text",class:"form-control",id:"name"},null,512),[[_,o.name]]),o.errors.hasOwnProperty("name")?(r(),l("small",D,p(o.errors.name),1)):n("",!0)]),e("div",I,[E,m(e("input",{"onUpdate:modelValue":s[1]||(s[1]=a=>o.role=a),type:"text",class:"form-control",id:"role"},null,512),[[_,o.role]]),o.errors.hasOwnProperty("role")?(r(),l("small",N,p(o.errors.role),1)):n("",!0)]),e("div",L,[o.installedPhoto?(r(),l("div",O,[e("img",{src:o.installedPhoto,class:"w-50",alt:"Фото участника"},null,8,R)])):n("",!0),F,e("input",{onChange:s[2]||(s[2]=(...a)=>d.handlePhotoUpload&&d.handlePhotoUpload(...a)),ref:"files",class:"form-control",type:"file",id:"photo"},null,544),o.errors.hasOwnProperty("photo")?(r(),l("small",z,p(o.errors.photo),1)):n("",!0)]),e("div",M,[j,x(f,{class:"btn btn-secondary",to:"/admin/participants"},{default:U(()=>[v("Отмена")]),_:1})])],32)])],64)}const K=y(A,[["render",q],["__scopeId","data-v-8aead463"]]);export{K as default};