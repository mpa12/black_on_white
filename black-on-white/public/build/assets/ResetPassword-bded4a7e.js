import{T as m}from"./Toast-5fd08f16.js";import{_,r as u,o as l,c as i,h,i as d,a as t,k as b,l as f,m as w,t as P,F as v,p as x,d as y}from"./app-b806d1ea.js";const k={name:"ResetPassword",components:{Toast:m},data(){return{email:null,errors:[],success:!1}},methods:{resetPassword(){axios.post("/api/auth/reset-password",{email:this.email}).then(()=>{this.success=!0,this.email=null,this.errors=[]}).catch(e=>{if(console.log(e),e.response.status===422){let s=JSON.parse(e.request.responseText).errors;for(const r in s)s[r]=s[r][0];this.errors=s}})}}},n=e=>(x("data-v-bbf3d37b"),e=e(),y(),e),S={class:"reset-password-section"},g=n(()=>t("h1",{class:"mb-4"},"Восстановление пароля",-1)),E={class:"mb-3"},R=n(()=>t("label",{for:"email",class:"form-label"},"E-mail",-1)),U={key:0,class:"text-danger"},V=n(()=>t("button",{type:"submit",class:"btn btn-circle mb-4"},"Восстановить",-1));function B(e,s,r,I,o,c){const p=u("toast");return l(),i(v,null,[o.success?(l(),h(p,{key:0,title:"На почту отправлено письмо"})):d("",!0),t("section",S,[t("form",{class:"reset-password-wrapper",onSubmit:s[1]||(s[1]=b((...a)=>c.resetPassword&&c.resetPassword(...a),["prevent"]))},[g,t("div",E,[R,f(t("input",{"onUpdate:modelValue":s[0]||(s[0]=a=>o.email=a),type:"text",class:"form-control",id:"email",placeholder:"E-mail"},null,512),[[w,o.email]]),o.errors.hasOwnProperty("email")?(l(),i("small",U,P(o.errors.email),1)):d("",!0)]),V],32)])],64)}const A=_(k,[["render",B],["__scopeId","data-v-bbf3d37b"]]);export{A as default};