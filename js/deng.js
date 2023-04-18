function deng(form) {
    if (form.email.value == "") {
        alert("请输入邮箱!");
        form.email.focus();
        return false;
    }
    if (form.pass.value == "") {
        alert("请输入密码!");
        form.pass.focus();
        return false;
    }
    form.submit();
}