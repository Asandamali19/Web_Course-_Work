document.addEventListener("DOMContentLoaded", function () {
  document.querySelector("form").addEventListener("submit", function (e) {
    const userName = document.getElementById("userName").value.trim();
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirm_password").value;
    const fullName = document.getElementById("fullname").value.trim();
    const genderMale = document.getElementById("male").checked;
    const genderFemale = document.getElementById("female").checked;
    const dob = document.getElementById("dob").value;
    const email = document.getElementById("email").value.trim();
    const phone = document.getElementById("phone").value.trim();
    const addL1 = document.getElementById("AddL1").value.trim();
    const zip = document.getElementById("zipcode").value.trim();

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const phonePattern = /^[0-9]{10}$/;
    const zipPattern = /^[0-9]{5}$/;

    if (
      userName === "" ||
      password === "" ||
      confirmPassword === "" ||
      fullName === "" ||
      (!genderMale && !genderFemale) ||
      dob === "" ||
      email === "" ||
      phone === "" ||
      addL1 === ""
    ) {
      alert("Please fill out all required fields.");
      e.preventDefault();
      return;
    }

    if (password !== confirmPassword) {
      alert("Passwords do not match.");
      e.preventDefault();
      return;
    }

    if (!emailPattern.test(email)) {
      alert("Please enter a valid email address.");
      e.preventDefault();
      return;
    }

    if (!phonePattern.test(phone)) {
      alert("Please enter a valid 10-digit phone number.");
      e.preventDefault();
      return;
    }

    if (zip !== "" && !zipPattern.test(zip)) {
      alert("Zip Code must be exactly 5 digits.");
      e.preventDefault();
      return;
    }
  });
});
