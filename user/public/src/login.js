function validateForm() {
    let mail = document.forms["loginForm"]["mail"].value;
    let pass = document.forms["loginForm"]["pass"].value;
    let errors = [];
  
    if (!mail.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
        errors.push("正しいメールアドレスを入力してください。");
    }
      
    if (pass.length < 6 || pass.length > 30) {
      errors.push("パスワードは8文字以上30文字以下で入力してください。");
    }
      
    if (errors.length > 0) {
        alert(errors.join("\n"));
        return false;
    }
      
  return true;
}
