package Controller.User;

import java.io.IOException;

import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import javax.servlet.http.HttpSession;
import Model.ContentModel;
import Model.Model;
import Model.MySQLConnect;
import Model.QueryResult;
import javax.servlet.RequestDispatcher;

//@WebServlet(name = "ContentCon", urlPatterns = {"/ContentCon"})
public class ProfilePageCon extends HttpServlet {

    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.setContentType("text/html;charset=UTF-8");

        int ID = Integer.parseInt(request.getParameter("user"));

        Model bean = new Model();
        QueryResult users = MySQLConnect.query("select * from user");
        QueryResult user = MySQLConnect.query("select * from user where ID_USER=" + ID);
        QueryResult userComments = MySQLConnect.query("select * from komentar where ID_USER=" + ID);
        QueryResult userPosts = MySQLConnect.query("select * from konten natural join user where konten.ID_USER=" + ID);
        QueryResult userAchievements = MySQLConnect.query("select * from user_achievement natural join achievement where ID_USER=" + ID);

        if (users.count() > 0) {
            bean.display.put("users", users);
            bean.display.put("user", user);
            bean.display.put("comments", userComments);
            bean.display.put("posts", userPosts);
            bean.display.put("achievements", userAchievements);
        }

        HttpSession session = request.getSession();
        session.setAttribute("bean", bean);

        RequestDispatcher rd;
        if (user.count() == 0) {
            rd = getServletContext().getRequestDispatcher("/ErrorPage");
            rd.forward(request, response);
        } else {
            rd = getServletContext().getRequestDispatcher("/header.jsp");
            rd.include(request, response);
            rd = getServletContext().getRequestDispatcher("/ProfileView.jsp");
            rd.include(request, response);
            rd = getServletContext().getRequestDispatcher("/footer.jsp");
            rd.include(request, response);
        }
    }//

// <editor-fold defaultstate="collapsed" desc="HttpServlet methods. Click on the +sign on the left to edit the code.">
    /**
     * Handles the HTTP
     * <code>GET</code> method.
     *
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
     * Handles the HTTP
     * <code>POST</code> method.
     *
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
     *
     * @return a String containing servlet description
     *
     */
    @Override
    public String getServletInfo() {
        return "Short description";
    }// </editor-fold>
}