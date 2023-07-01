import{T as h}from"./Toast-d9fb1dce.js";import{_ as b,r as f,o as l,c as n,h as w,i,a as t,k as g,l as m,m as p,t as d,F as y,p as x,d as v}from"./app-bded94c7.js";const k={name:"Register",components:{Toast:h},data(){return{name:null,email:null,password:null,errors:[],created:!1}},methods:{register(){axios.post("/api/auth/register",{name:this.name,email:this.email,password:this.password}).then(()=>{this.created=!0,this.name=null,this.email=null,this.password=null,this.errors=[]}).catch(o=>{if(console.log(o),o.response.status===422){let e=JSON.parse(o.request.responseText).errors;for(const c in e)e[c]=e[c][0];this.errors=e}})}}},a=o=>(x("data-v-b859b552"),o=o(),v(),o),S={class:"register-section"},V=a(()=>t("h1",{class:"mb-4"},"Регистрация",-1)),B={class:"mb-3"},I=a(()=>t("label",{for:"name",class:"form-label"},"Имя пользователя",-1)),O={key:0,class:"text-danger"},T={class:"mb-3"},E=a(()=>t("label",{for:"email",class:"form-label"},"E-mail",-1)),N={key:0,class:"text-danger"},P={class:"mb-3"},R=a(()=>t("label",{for:"password",class:"form-label"},"Пароль",-1)),U={key:0,class:"text-danger"},C=a(()=>t("button",{type:"submit",class:"btn btn-circle mb-4"},"Зарегистрироваться",-1));function D(o,e,c,F,s,_){const u=f("toast");return l(),n(y,null,[s.created?(l(),w(u,{key:0,title:"Аккаунт успешно создан"})):i("",!0),t("section",S,[t("form",{class:"register-wrapper",onSubmit:e[3]||(e[3]=g((...r)=>_.register&&_.register(...r),["prevent"]))},[V,t("div",B,[I,m(t("input",{"onUpdate:modelValue":e[0]||(e[0]=r=>s.name=r),type:"text",class:"form-control",id:"name",placeholder:"Имя пользователя"},null,512),[[p,s.name]]),s.errors.hasOwnProperty("name")?(l(),n("small",O,d(s.errors.name),1)):i("",!0)]),t("div",T,[E,m(t("input",{"onUpdate:modelValue":e[1]||(e[1]=r=>s.email=r),type:"text",class:"form-control",id:"email",placeholder:"E-mail"},null,512),[[p,s.email]]),s.errors.hasOwnProperty("email")?(l(),n("small",N,d(s.errors.email),1)):i("",!0)]),t("div",P,[R,m(t("input",{"onUpdate:modelValue":e[2]||(e[2]=r=>s.password=r),type:"password",class:"form-control",id:"password",placeholder:"Пароль"},null,512),[[p,s.password]]),s.errors.hasOwnProperty("password")?(l(),n("small",U,d(s.errors.password),1)):i("",!0)]),C],32)])],64)}const J=b(k,[["render",D],["__scopeId","data-v-b859b552"]]);export{J as default};
