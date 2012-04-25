/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package Controller.User;

import Model.Constant;
import Model.Model;
import Model.MySQLConnect;
import Model.QueryResult;
import Model.User;
import Model.userData;
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
 * @author masphei
 */
public class RegisterProcessCon extends HttpServlet {

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
        PrintWriter out = response.getWriter();
        Model bean = new Model();
        HttpSession session = request.getSession(true);
            if(request.getParameter("isregister")!=null){
                String username = "";
                String name = "";
                String password = "";
                String confirm = "";
                String email = "";
                String birthdate = "";
                String gender = "";
                String status = "";
                String about = "";
                String avatar="";

                String error_username = "";
                String error_nama = "";
                String error_password = "";
                String error_confirm = "";
                String error_email = "";
                String error_tanggal="";
                String error_gender="";
                String error_status="";
                String error_avatar="";
                String insert="";
                String Query="";
                FileItem imageUpload = null;
                File savedFile = null;
                boolean isMultipart = FileUpload.isMultipartContent(request);
                if (!isMultipart) {
                    System.out.println(" Form Bukan Multipart...!!!");
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
                        String fieldName = item.getFieldName();
                        String value = item.getString();
                        if(fieldName.equals("username")){
                            username = value;
                            System.out.println("username " + username);
                        }else if(fieldName.equals("name")){
                            name = value;
                            System.out.println("name " + name);
                        }else if(fieldName.equals("password")){
                            password = value;
                            System.out.println("pass " + password);
                        }else if(fieldName.equals("confirm")){
                            confirm = value;
                            System.out.println("confirm " + confirm);
                        }else if(fieldName.equals("email")){
                            email  = value;
                            System.out.println("email " + email);
                        }else if(fieldName.equals("birthdate")){
                            birthdate = value;
                            System.out.println("birthdate " + birthdate);
                        }else if(fieldName.equals("gender")){
                            gender = value;
                            System.out.println("gender " + gender);
                        }else if(fieldName.equals("status")){
                            status = value;
                            System.out.println("status " + status);
                        }
                    } else {
                        File fullFile = new File(item.getName());
                        avatar = fullFile.getName();
                        System.out.println("avatar "+avatar);
                        imageUpload=item;
                    }
                }            
                    
//                userData user = new userData();          
//                user.setUsername(request.getParameter("username"));
//                user.setName(request.getParameter("name"));
//                user.setPassword(request.getParameter("password"));
//                user.setConfirm(request.getParameter("confirm"));
//                user.setEmail(request.getParameter("email"));
//                user.setBirthdate(request.getParameter("birthdate"));
//                //user.setAvatar(request.getParameter("avatar"));
//                user.setGender(request.getParameter("gender"));
//                user.setStatus(request.getParameter("status"));
//                user.setAbout(request.getParameter("about"));

                if(username.length()>45 || username.length()>45 
                        || confirm.length()>45 
                        || email.length()>45 || birthdate.length()>45 || 
                        gender.length()>45 || about.length()>45 ){
                        response.sendRedirect("/RegisterPage");
                        }
                else{
                    bean.display.put("username", username);
                    bean.display.put("password", password);
                    bean.display.put("confirm", confirm);
                    bean.display.put("email", email);
                    bean.display.put("birthdate", birthdate);
                    bean.display.put("gender", password);
                    bean.display.put("status", confirm);
                    bean.display.put("about", email);
                    bean.display.put("name", name);
         //           this->set('nama', name);
         //           this->set('password', password);
         //           this->set('confirm', confirm);
         //           this->set('email', email);
         //           this->set('birthdate', birthdate);
         //           this->set('avatar', avatar);
                    if(gender.equals("male")) gender = "male";
                    else if(gender.equals("female")) gender = "female";
                    if(status.equals("single")) {status = "SINGLE" ;}
                    else if(status.equals("relation")) {status = "IN RELATIONSHIP";}
                    else if(status.equals("married")) {status="MARRIED";}
                    if(username.length()<5) {
                        error_username = "Username must be at least 5 character.";}
                    else{
                        if (!username.matches("^[a-z0-9_-]{5,45}$")) error_username = "Username must be alphanumeric.";
                        else{
                            if(userData.checkUsername(username) == true) error_username = "Username has been taken";
                            else{
                                //if(!name.matches("^(^([a-zA-Z '-]+)$")) out.println ("nama salah");
                                if(!name.matches("^([A-Za-z0-9])+([ ])+([A-Za-z0-9]){1,45}")) error_nama = "Please include your last name.";
                                else{
                                    if(password.length()<8) error_password = "Password must be at least 8 character.";
                                    else {
                                        if(password.equals(username)) error_password = "Password cannot be same with Username";
                                        else {
                                            if(password.matches("^[a-zA-Z0-9]")) error_password = "The password is must be alphanumeric.";
                                            else{
                                                if(password.equals("") || !password.equals(confirm)) error_confirm="The password is not match";
                                                else{
                                                if(!password.matches("^([A-Za-z0-9])+([A-Za-z0-9])$")) out.println("password salah");
                                                    if(!email.matches("^[_A-Za-z0-9-]+(\\.[_A-Za-z0-9-]+)*@[A-Za-z0-9]+(\\.[A-Za-z0-9]+)*(\\.[A-Za-z]{2,})$")) error_email="Wrong email format";
                                                    else {
                                                        if(userData.checkEmail(email)) error_email="Email has been taken.";
                                                        else{
                                                            if(!birthdate.matches("\\d{4}-\\d{2}-\\d{2}")) error_tanggal="Birth date must be written in YYYY-MM-DD";
                                                            else{
                                                                if(!userData.checkDate(birthdate)) error_tanggal="The date is invalid";
                                                                else{
                                                                    if(gender.isEmpty() || gender.equals("none")) error_gender="You must select a gender.";
                                                                    else{
                                                                        if(status.isEmpty() || status.equals("none")) error_status="Actually you have a status.";
                                                                        else{
                                                                            if(avatar!=null && !avatar.equals("")){
                                                                                if((avatar.length()>4 && avatar.toLowerCase().charAt(avatar.length()-1)=='g' &&
                                                                                        avatar.toLowerCase().charAt(avatar.length()-2)=='p' && 
                                                                                        avatar.toLowerCase().charAt(avatar.length()-3)=='j' &&
                                                                                        avatar.toLowerCase().charAt(avatar.length()-4)=='.') ||
                                                                                    (avatar.length()>5 && avatar.toLowerCase().charAt(avatar.length()-1)=='g' &&
                                                                                        avatar.toLowerCase().charAt(avatar.length()-2)=='e' && 
                                                                                        avatar.toLowerCase().charAt(avatar.length()-3)=='p' &&
                                                                                        avatar.toLowerCase().charAt(avatar.length()-4)=='j' &&
                                                                                        avatar.toLowerCase().charAt(avatar.length()-5)=='.'))
                                                                                                {
                                                                                    System.out.println("avatar exist");
                                                                                    String sPath = getServletConfig().getServletContext().getRealPath("/avatar");
                                                                                    System.out.println("Lokasi penyimpanan file =" + sPath);
                                                                                    savedFile = new File(sPath, avatar);
                                                                                    try {
                                                                                        imageUpload.write(savedFile);
                                                                                        gender = (gender.equals("male"))? "LAKI" : "PEREMPUAN";
                                                                                        insert = "insert into user (USERNAME, PASSWORD, NAMA, TGL_LAHIR, EMAIL, AVATAR, GENDER, ABOUT_ME, STATUS) "
                                                                                                + "values (\""+username+"\", \""+Constant.md5(password) +"\","
                                                                                                + "\""+name+"\", \""+birthdate+"\","
                                                                                                + "\""+email+"\", \""+avatar+"\","
                                                                                                + "\""+gender+"\", \""+about+"\","
                                                                                                + "\""+status+"\")";
                                                                                        if(MySQLConnect.sQuery(insert)){
                                                                                            System.out.println("berhasil");
                                                                                            QueryResult qr = MySQLConnect.query("select * from user where USERNAME=\""+username+"\"");
                                                                                            if(qr.count()>0){ // ada
                                                                                                User user = new User();
                                                                                                user.setUsername(qr.get(0, "USERNAME"));
                                                                                                user.setPassword(qr.get(0, "PASSWORD"));

                                                                                                user = UserDAO.login(user);

                                                                                                if (user.isValid()) {
                                                                                                    session.setAttribute("user", user);
                                                                                                    session.setAttribute("login", true);
                                                                                                    response.sendRedirect("ProfilePage?user=" + user.getID_User()); //logged-in page 
                                                                                                }
                                                                                            }                                                                                            
                                                                                        }else System.out.println("query gagal");
                                                                                    } catch (Exception e) {
                                                                                        System.out.println("Ada Kesalahan ketika menyimpan File :" + e.getMessage());
                                                                                    }                                                
                                                                                }else{
                                                                                    System.out.println("Image invalid");
                                                                                    error_avatar="Please upload jpeg or jpg image.";
                                                                                }
                                                                            }
                                                                            else{
                                                                                System.out.println("Image null");
                                                                                error_avatar="Please upload an image";
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    
                   
                  //  $this->loadView("header_view.php");
                  //  $this->loadView("register_view.php");		
                  //  $this->loadView("footer_view.php"); 
                }
                
                    bean.display.put("gender", gender);
                    bean.display.put("status", status);
                    bean.display.put("about", about);
                    bean.display.put("error_username", error_username);
                    bean.display.put("error_nama", error_nama);
                    bean.display.put("error_password", error_password);
                    bean.display.put("error_confirm", error_confirm);
                    bean.display.put("error_email", error_email);
                    bean.display.put("error_tanggal", error_tanggal);
                    bean.display.put("error_gender", error_gender);
                    bean.display.put("error_status", error_status);
                    bean.display.put("error_avatar", error_avatar);
                    session.setAttribute("bean", bean);

                    RequestDispatcher rd;
                    rd = getServletContext().getRequestDispatcher("/header.jsp");
                    rd.include(request, response);
                    rd = getServletContext().getRequestDispatcher("/RegisterView.jsp");
                    rd.include(request, response);
                    rd = getServletContext().getRequestDispatcher("/footer.jsp");
                    rd.include(request, response);
      }

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
