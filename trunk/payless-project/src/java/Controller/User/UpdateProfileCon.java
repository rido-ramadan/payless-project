/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package Controller.User;

import Model.Constant;
import Model.Model;
import Model.MySQLConnect;
import Model.User;
import java.io.File;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.Iterator;
import java.util.List;
import javax.servlet.RequestDispatcher;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;
import org.apache.commons.fileupload.DiskFileUpload;
import org.apache.commons.fileupload.FileItem;
import org.apache.commons.fileupload.FileUpload;

/**
 *
 * @author Edgar Drake
 */
public class UpdateProfileCon extends HttpServlet {

    /**
     * Processes requests for both HTTP
     * <code>GET</code> and
     * <code>POST</code> methods.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.setContentType("text/html;charset=UTF-8");
        PrintWriter out = response.getWriter();
        try {
            //<editor-fold defaultstate="collapsed" desc="testing part">
            /*
             * HttpSession session = request.getSession(true); User user =
             * ((User) session.getAttribute("user"));
             *
             * String email = request.getParameter("email"); String gender =
             * request.getParameter("gender"); String status =
             * request.getParameter("status"); String avatar =
             * request.getParameter("avatar"); String about =
             * request.getParameter("about");
             *
             * String query = "update user " + "set EMAIL='" + email + "', " +
             * // "STATUS='" + status + "', " + // "GENDER='" + gender + "', " +
             * "ABOUT_ME='" + about + "'" + "where ID_USER='" +
             * user.getID_User() + "';"; MySQLConnect.sQuery(query); //
             * MySQLConnect.sQuery("INSERT INTO user (EMAIL, AVATAR, GENDER,
             * ABOUT_ME, STATUS) VALUES(" + email + "," + avatar + "," + gender
             * + "," + about + "," + status + ")");
             */
            //</editor-fold>

            RequestDispatcher rd;
            Model bean = new Model();
            HttpSession session = request.getSession(true);
            if (session.getAttribute("login") == null) {
                response.sendRedirect("/Home");
            } else {
                if (request.getParameter("id") != null) { // upload process
                    String email = null, gender = null, status = null, avatar = null, about = null;
                    FileItem imageUpload = null;
                    File savedFile = null;
                    boolean isMultipart = FileUpload.isMultipartContent(request);
                    if (!isMultipart) {
                        System.out.println(" Form is not Multipart...!!!");
                        return;
                    }
                    DiskFileUpload upload = new DiskFileUpload();
                    List items = null;
                    try {
                        items = upload.parseRequest(request);
                    } catch (Exception e) {
                        System.out.println("Exception = " + e.getMessage());
                    }

                    Iterator itr = items.iterator();
                    while (itr.hasNext()) {
                        FileItem item = (FileItem) itr.next();
                        if (item.isFormField()) {
                            String name = item.getFieldName();
                            String value = item.getString();
                            if (name.equals("email")) {
                                email = value;
                                System.out.println("e-mail : " + value);
                            } else if (name.equals("gender")) {
                                gender = value;
                                System.out.println("gender : " + value);
                            } else if (name.equals("status")) {
                                status = value;
                                System.out.println("status :  " + value);
                            } else if (name.equals("about")) {
                                about = value;
                                System.out.println("about me : " + value);
                            }
                        } else {
                            File fullFile = new File(item.getName());
                            System.out.println("File Lengkap : " + fullFile.getName());
                            avatar = fullFile.getName();
                            System.out.println("image : " + avatar);
                            imageUpload = item;
                        }
                    }

                    if (gender != null) {
                        bean.display.put("gender_select", gender);
                    }
                    if (status != null) {
                        bean.display.put("status_select", status);
                    }
                    
                    User user = ((User)session.getAttribute("user"));
                    String query = "update user set " + "EMAIL='" + email + "', " +  
                                                        "STATUS='" + status + "', " + 
                                                        "GENDER='" + gender + "', " +
                                                        "ABOUT_ME='" + about + "'" +
                                                        "where ID_USER='" + user.getID_User() + "';";
                    MySQLConnect.sQuery(query);
                    System.out.println("OK");
                    session.setAttribute("bean", bean);
                    System.out.println(user.getID_User());
                    response.sendRedirect("/ProfilePage?user=" + user.getID_User());
                }

            }
            session.setAttribute("bean", bean);

            //<editor-fold defaultstate="collapsed" desc="dispatcher">
//            rd = getServletContext().getRequestDispatcher("/ProfilePage?user=" + user.getID_User());
//            rd.forward(request, response);
            //</editor-fold>
        } finally {
            out.close();
        }
    }

    // <editor-fold defaultstate="collapsed" desc="HttpServlet methods. Click on the + sign on the left to edit the code.">
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
     */
    @Override
    public String getServletInfo() {
        return "Short description";
    }// </editor-fold>
}
