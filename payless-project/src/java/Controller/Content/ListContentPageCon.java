package Controller.Content;

import java.io.IOException;

import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import javax.servlet.http.HttpSession;
import Model.ContentModel;
import javax.servlet.RequestDispatcher;

//@WebServlet(name = "ContentCon", urlPatterns = {"/ContentCon"})
public class ListContentPageCon extends HttpServlet {

protected void processRequest(HttpServletRequest request, HttpServletResponse response)
throws ServletException, IOException {
response.setContentType("text/html;charset=UTF-8");
ContentModel myBean = new ContentModel();
myBean.setUserName( "Alfian");
HttpSession session = request.getSession();
session.setAttribute("beanInfo", myBean);
RequestDispatcher rd;
rd =getServletContext().getRequestDispatcher("/header.jsp");
rd.include(request, response);
rd =getServletContext().getRequestDispatcher("/ListContentView.jsp");
rd.include(request, response);
rd =getServletContext().getRequestDispatcher("/footer.jsp");
rd.include(request, response);
}//

// <editor-fold defaultstate="collapsed" desc="HttpServlet methods. Click on the +sign on the left to edit the code.">
/**
* Handles the HTTP <code>GET</code> method.
* @param request servlet request
* @param response servlet response
* @throws ServletException if a servlet-specific error occurs
* @throws IOException if an I/O error occurs
*/
@Override
protected void doGet(HttpServletRequest request, HttpServletResponse response)
throws ServletException, IOException {
processRequest(request, response);
}

/**
* Handles the HTTP <code>POST</code> method.
* @param request servlet request
* @param response servlet response
* @throws ServletException if a servlet-specific error occurs
* @throws IOException if an I/O error occurs
*/
@Override
protected void doPost(HttpServletRequest request, HttpServletResponse response)
throws ServletException, IOException {
processRequest(request, response);
}

/**
* Returns a short description of the servlet.
* @return a String containing servlet description

*/
@Override
public String getServletInfo() {
return "Short description";
}// </editor-fold>

}