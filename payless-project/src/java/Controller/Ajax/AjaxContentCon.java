/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package Controller.Ajax;

import Model.MySQLConnect;
import Model.QueryResult;
import Model.User;
import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletConfig;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

/**
 *
 * @author masphei
 */
public class AjaxContentCon extends HttpServlet {

    /** 
     * Processes requests for both HTTP <code>GET</code> and <code>POST</code> methods.
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.setContentType("text/html;charset=UTF-8");
        String name = null;
        PrintWriter out = response.getWriter();
        HttpSession session = request.getSession(true);
        User user = (User)session.getAttribute("user");
        int id_konten = Integer.parseInt(request.getParameter("id_konten"));
        if(((String)request.getParameter("ajax")).equals("like")){
            System.out.println("like");
             ajax_like(out, id_konten, user.getID_User());
        }
        if(((String)request.getParameter("ajax")).equals("dislike")){
            System.out.println("dislike");
             ajax_dislike(out, id_konten, user.getID_User());
        }
        if(((String)request.getParameter("ajax")).equals("unlike")){
            System.out.println("unlike");
             ajax_unlike(out, id_konten, user.getID_User());
        }
        if(((String)request.getParameter("ajax")).equals("undislike")){
            System.out.println("undislike");
             ajax_undislike(out, id_konten, user.getID_User());
        }
    }
    
    public void ajax_unlike(PrintWriter out, int id_konten, int id_user){
        QueryResult user_like = MySQLConnect.query("select * from like_dislike where ID_KONTEN="+id_konten+" AND ID_USER="+id_user);
        if(user_like.count()>0){ // sudah ada
            if(MySQLConnect.sQuery("delete from like_dislike where ID_KONTEN="+id_konten+" AND ID_USER="+id_user+" AND STATUS=\"LIKE\"")){
                out.println(1);
            }
        }                        
    }
    public void ajax_undislike(PrintWriter out, int id_konten, int id_user){
        QueryResult user_like = MySQLConnect.query("select * from like_dislike where ID_KONTEN="+id_konten+" AND ID_USER="+id_user);
        if(user_like.count()>0){ // sudah ada
            if(MySQLConnect.sQuery("delete from like_dislike where ID_KONTEN="+id_konten+" AND ID_USER="+id_user+" AND STATUS=\"DISLIKE\"")){
                out.println(1);
            }
        }                        
    }
    public void ajax_like(PrintWriter out, int id_konten, int id_user){
        QueryResult user_like = MySQLConnect.query("select * from like_dislike where ID_KONTEN="+id_konten+" AND ID_USER="+id_user);
        if(user_like.count()<=0){ // kosong
            String insert = "insert into like_dislike (ID_KONTEN, ID_USER, STATUS) "
                    + "values ("+id_konten+", "+id_user+","
                    + "\"LIKE\")";
            MySQLConnect.sQuery(insert);
        }else{
            String update = "update like_dislike set STATUS=\"LIKE\""
            + "where ID_KONTEN="+id_konten+" AND ID_USER="+id_user;
            MySQLConnect.sQuery(update);
        }
    }
    public void ajax_dislike(PrintWriter out, int id_konten, int id_user){
        QueryResult user_like = MySQLConnect.query("select * from like_dislike where ID_KONTEN="+id_konten+" AND ID_USER="+id_user);
        if(user_like.count()<=0){ // kosong
            String insert = "insert into like_dislike (ID_KONTEN, ID_USER, STATUS) "
                    + "values ("+id_konten+", "+id_user+","
                    + "\"DISLIKE\")";
            MySQLConnect.sQuery(insert);
        }else{
            String update = "update like_dislike set STATUS=\"DISLIKE\""
            + "where ID_KONTEN="+id_konten+" AND ID_USER="+id_user;
            MySQLConnect.sQuery(update);
        }
    }
        
    public void init(ServletConfig config) throws ServletException { 
      super.init(config);
     }

     public void destroy() {

     }

    // <editor-fold defaultstate="collapsed" desc="HttpServlet methods. Click on the + sign on the left to edit the code.">
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
