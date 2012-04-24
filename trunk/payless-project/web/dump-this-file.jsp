<%-- 
    Document   : dump-this-file
    Created on : 24 Apr 12, 10:49:04
    Author     : Edgar Drake
--%>

<%@page import="Model.User"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
    <body>
        <h1>Hello World!</h1>
        <%
            User user = ((User) session.getAttribute("user"));
            if (user != null) {
                out.println("<a class='topbutton myaccount' href='/ProfilePage' id='myacctButton' title='Sign Up'></a>");
                out.println("<a class='topbutton signout' id='loginButton' alt='Log Out' href='/Logout'></a>");
            } else {
                out.println("<a class='topbutton login' id='loginButton' alt='Log In' onclick='showPopup();'></a>");
                out.println("<a class='topbutton signup' href='/RegisterPage' id='myacctButton' title='Sign Up'></a>");
            }
        %>
    </body>
</html>
