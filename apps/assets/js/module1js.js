// User list
var userList = [
  {
    username: "admin",
    password: "admin123",
    userType: "admin"
  },
  {
    username: "expert1",
    password: "expert123",
    userType: "expert"
  },
  {
    username: "user1",
    password: "user123",
    userType: "user"
  },
  // Add more users as needed
];

// Function to handle login
function login() {
  // Get the entered username and password
  var username = document.getElementById("username").value;
  var password = document.getElementById("password").value;

  // Check if the entered credentials match any user in the user list
  var user = userList.find(function(user) {
    return user.username === username && user.password === password;
  });

  if (user) {
    // Set session data
    sessionStorage.setItem("loggedInUser", JSON.stringify(user));

    // Redirect to appropriate page based on user type
    if (user.userType === "admin") {
      window.location.href = "admin_dashboard.html";
    } else if (user.userType === "expert") {
      window.location.href = "expert_dashboard.html";
    } else {
      window.location.href = "user_dashboard.html";
    }
  } else {
    alert("Invalid username or password");
  }
}

// Function to check if the user is already logged in
function checkLoggedIn() {
  var loggedInUser = sessionStorage.getItem("loggedInUser");
  if (loggedInUser) {
    var user = JSON.parse(loggedInUser);

    // Redirect to appropriate page based on user type
    if (user.userType === "admin") {
      window.location.href = "admin_dashboard.html";
    } else if (user.userType === "expert") {
      window.location.href = "expert_dashboard.html";
    } else {
      window.location.href = "user_dashboard.html";
    }
  }
}

// Function to handle logout
function logout() {
  sessionStorage.removeItem("loggedInUser");
  window.location.href = "login.html";
}
