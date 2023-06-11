import{T as c}from"./Toast-dab88776.js";import{_ as m,r as h,o as r,c as n,h as u,i as a,a as o,l as w,m as k,t as b,k as f,F as v,p as P,d as y}from"./app-51fe443e.js";const R={name:"ResetPasswordResponse",components:{Toast:c},data(){return{remember_token:null,token_valid:!0,new_password:null,errors:[],success:!1}},mounted(){this.remember_token=this.$route.params.remember_token,this.tokenIsValid()},methods:{tokenIsValid(){axios.post("http://localhost:8080/api/auth/validate-token",{remember_token:this.remember_token}).then(()=>{this.token_valid=!0}).catch(e=>{console.log(e),this.token_valid=!1})},resetPassword(){axios.post("http://localhost:8080/api/auth/reset-password-response",{remember_token:this.remember_token,new_password:this.new_password}).then(()=>{this.new_password=null,this.errors=[],this.success=!0}).catch(e=>{if(console.log(e),e.response.status===422){let s=JSON.parse(e.request.responseText).errors;for(const _ in s)s[_]=s[_][0];this.errors=s}})}}},l=e=>(P("data-v-e98e2eed"),e=e(),y(),e),x={key:1,class:"invalid-token"},U=l(()=>o("h3",null,"Пользователь не найден",-1)),V=[U],g={key:2,class:"reset-password-response"},I=l(()=>o("h1",{class:"mb-4"},"Восстановление пароля",-1)),S={class:"mb-3"},E=l(()=>o("label",{for:"password",class:"form-label"},"Пароль",-1)),A={key:0,class:"text-danger"},B=l(()=>o("button",{type:"submit",class:"btn btn-circle mb-4"},"Восстановить пароль",-1));function L(e,s,_,T,t,i){const p=h("toast");return r(),n(v,null,[t.success?(r(),u(p,{key:0,title:"Пароль успешно изменен"})):a("",!0),t.token_valid?a("",!0):(r(),n("section",x,V)),t.token_valid?(r(),n("section",g,[o("form",{class:"reset-password-response-wrapper",onSubmit:s[1]||(s[1]=f((...d)=>i.resetPassword&&i.resetPassword(...d),["prevent"]))},[I,o("div",S,[E,w(o("input",{"onUpdate:modelValue":s[0]||(s[0]=d=>t.new_password=d),type:"password",class:"form-control",id:"password",placeholder:"Введите новый пароль"},null,512),[[k,t.new_password]]),t.errors.hasOwnProperty("new_password")?(r(),n("small",A,b(t.errors.new_password),1)):a("",!0)]),B],32)])):a("",!0)],64)}const D=m(R,[["render",L],["__scopeId","data-v-e98e2eed"]]);export{D as default};
