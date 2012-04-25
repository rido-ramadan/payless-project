package Controller.Content;

import Model.Constant;
import java.io.IOException;

import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import javax.servlet.http.HttpSession;
import Model.ContentModel;
import Model.Model;
import Model.MySQLConnect;
import Model.User;
import java.io.File;
import java.util.Iterator;
import java.util.List;
import java.util.regex.Matcher;
import java.util.regex.Pattern;
import javax.servlet.RequestDispatcher;
import org.apache.commons.fileupload.DiskFileUpload;
import org.apache.commons.fileupload.FileItem;
import org.apache.commons.fileupload.FileUpload;

public class UploadPageCon extends HttpServlet {

    public boolean isContainYoutube(String s){
        String regex = "^(http://)?www.youtube.com/?+$";
        try {
            Pattern patt = Pattern.compile(regex);
            Matcher matcher = patt.matcher(s);
            return matcher.matches();
        } catch (RuntimeException e) {
        return false;        
        }
    }
    public boolean isContainWatch(String s){
        String regex = "^(http://)?www.youtube.com/watch\\?+$";
        try {
            Pattern patt = Pattern.compile(regex);
            Matcher matcher = patt.matcher(s);
            return matcher.matches();
        } catch (RuntimeException e) {
        return false;        
        }
    }
    public boolean isContainV(String s){
        String regex = "^(http://)?www.youtube.com/watch\\?v=/?+$";
        try {
            Pattern patt = Pattern.compile(regex);
            Matcher matcher = patt.matcher(s);
            return matcher.matches();
        } catch (RuntimeException e) {
        return false;        
        }
    }
    public boolean isContainCode(String s){
        String regex = "^(http://)?www.youtube.com/watch\\?v=+([0-9A-Za-z]{10,12})/?+[a-zA-Z0-9&#=_]{0,30}?";
        try {
            Pattern patt = Pattern.compile(regex);
            Matcher matcher = patt.matcher(s);
            return matcher.matches();
        } catch (RuntimeException e) {
        return false;
        }
    }
    public boolean isValidUrl(String s){
        String regex = "^(https?|ftp|file)://[-a-zA-Z0-9+&@#/%?=~_|!:,.;]*[-a-zA-Z0-9+&@#/%=~_|]";
        try {
            Pattern patt = Pattern.compile(regex);
            Matcher matcher = patt.matcher(s);
            return matcher.matches();
        } catch (RuntimeException e) {
        return false;
        }
    }
    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.setContentType("text/html;charset=UTF-8");
        RequestDispatcher rd;
        Model bean = new Model();
        HttpSession session = request.getSession(true);
        if(session.getAttribute("login")==null){
            // kosong
            response.sendRedirect("/Home");
        }else{
        
            if(request.getParameter("uploading")!=null){ // upload process
                    String title=null, description=null,  tags=null,link_input=null, type=null, image=null;
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
                            String name = item.getFieldName();
                            String value = item.getString();
                            if(name.equals("title")){
                                title = value;
                                System.out.println("title " + value);
                            }else if(name.equals("type")){
                                type = value;
                                System.out.println("type " + value);
                            }
                            else if(name.equals("link-input")){
                                link_input=value;
                                System.out.println("link " + value);
                            }
                            else if(name.equals("description")){
                                description=value;
                                System.out.println("deskripsi " + value);
                            }
                            else if(name.equals("tags")){
                                tags=value;
                                System.out.println("tags " + value);
                            }
                        } else {
                            File fullFile = new File(item.getName());
                            System.out.println("File Lengkap : " + fullFile.getName());
                            image = fullFile.getName();
                            System.out.println("image "+image);
                            imageUpload=item;
                        }
                    }            

                    boolean valid= false;
                    if(type!=null)
                        bean.display.put("radio_click",type);
                    if(title==null || title.equals("")){
                        System.out.println("title null");
                        bean.display.put("empty", "title");
                    }else{
                        bean.display.put("post_title", title);
                        if(type.equals("Link")){
                            if(link_input!=null){
                                bean.display.put("post_link", link_input);
                                if(isValidUrl(link_input)){
                                    System.out.println("link valid");
                                    if(description==null || description.equals("")){
                                        System.out.println("deskripsi tidak valid");
                                        bean.display.put("empty", "description");
                                    }else{
                                        // sukses
                                        valid = true;
                                        int id_user = ((User) session.getAttribute("user")).ID_User;
                                        int id_type = 1;
                                        String waktu = Constant.getDateTime();
                                        String judul = title;
                                        String link = link_input;
                                        String desc = description;
                                        String insert = "insert into konten (ID_USER, ID_TYPE, WAKTU, JUDUL, LINK, DESKRIPSI) "
                                                + "values (\""+id_user+"\", \""+id_type+"\","
                                                + "\""+waktu+"\", \""+judul+"\","
                                                + " \""+link+"\", \""+desc+"\")";
                                        if(MySQLConnect.sQuery(insert)){
                                            System.out.println("data berhasil dimasukkan");
                                        }
                                        Constant.inputTagsInLastKonten(tags);
                                    }
                                }else{
                                    System.out.println("url tidak valid");
                                    bean.display.put("empty", "link");
                                }
                            }else{
                                bean.display.put("empty", "link");
                            }
                        }
                        else if(type.equals("Image")){
                            if(image!=null && !image.equals("")){
                                if((image.length()>4 && image.toLowerCase().charAt(image.length()-1)=='g' &&
                                        image.toLowerCase().charAt(image.length()-2)=='p' && 
                                        image.toLowerCase().charAt(image.length()-3)=='j' &&
                                        image.toLowerCase().charAt(image.length()-4)=='.') ||
                                    (image.length()>5 && image.toLowerCase().charAt(image.length()-1)=='g' &&
                                        image.toLowerCase().charAt(image.length()-2)=='e' && 
                                        image.toLowerCase().charAt(image.length()-3)=='p' &&
                                        image.toLowerCase().charAt(image.length()-4)=='j' &&
                                        image.toLowerCase().charAt(image.length()-5)=='.'))
                                                {
                                    System.out.println("image exist");
                                    String sPath = getServletConfig().getServletContext().getRealPath("/image");
                                    System.out.println("Lokasi penyimpanan file =" + sPath);
                                    savedFile = new File(sPath, image);
                                    try {
                                        imageUpload.write(savedFile);
                                        int id_user = ((User)session.getAttribute("user")).getID_User();
                                        int id_type = 2;
                                        String waktu = Constant.getDateTime();
                                        String judul = title;
                                        String link = image;
                                        String desc = "";
                                        String insert = "insert into konten (ID_USER, ID_TYPE, WAKTU, JUDUL, LINK, DESKRIPSI) "
                                                + "values (\""+id_user+"\", \""+id_type+"\", "
                                                + "\""+waktu+"\", \""+judul+"\","
                                                + "\""+link+"\", \""+desc+"\")";
                                        if(MySQLConnect.sQuery(insert)){
                                            System.out.println("berhasil");
                                        }else System.out.println("query gagal");
                                        Constant.inputTagsInLastKonten(tags);
                                        valid = true;
                                    } catch (Exception e) {
                                        System.out.println("Ada Kesalahan ketika menyimpan File :" + e.getMessage());
                                    }                                                
                                }else{
                                    System.out.println("Image invalid");
                                    bean.display.put("empty", "image");                                
                                }
                            }
                            else{
                                System.out.println("Image invalid");
                                bean.display.put("empty", "image");
                            }
                        }
                        else if(type.equals("Video")){
                            String link = link_input;
                            if(!isContainCode(link)){
                                bean.display.put("empty", "video");
                                if(isContainV(link)){
                                    System.out.println("v benar");
                                }else {
                                    if(isContainWatch(link)){
                                        System.out.println("watch benar");
                                    }else {
                                        if(isContainYoutube(link)){
                                            System.out.println("link benar");
                                        }else {
                                            System.out.println("link salah");
                                        }
                                        System.out.println("watch salah");
                                    }
                                    System.out.println("v salah");
                                }

                                System.out.println("code salah");
                            }else{
                                System.out.println("code benar");
                                if(link!=null && !link.equals("")){
                                    String pos[] = link.split("watch\\?v=");
                                    System.out.println(pos[1]);
                                    String kode[] = pos[1].split("&");
                                    System.out.println(kode[0]);

                                    int id_user = ((User)session.getAttribute("user")).ID_User;
                                    int id_type = 3;
                                    String waktu = Constant.getDateTime();
                                    String judul = title;
                                    link = "http://www.youtube.com/embed/"+kode[0];
                                    String desc = "";
                                    String insert = "insert into konten (ID_USER, ID_TYPE, WAKTU, JUDUL, LINK, DESKRIPSI) "
                                            + "values (\""+id_user+"\", \""+id_type+"\","
                                            + "\""+waktu+"\", \""+judul+"\","
                                            + "\""+link+"\", \""+desc+"\""
                                            + ")";
                                    if(MySQLConnect.sQuery(insert)){
                                        System.out.println("query berhasil");
                                        valid = true;
                                    }
                                    Constant.inputTagsInLastKonten(tags);

                                }else bean.display.put("empty", "video");

                            }
                        }
                    }
                    if(!valid){ // gagal
                        session.setAttribute("bean", bean);
                        rd = getServletContext().getRequestDispatcher("/header.jsp");
                        rd.include(request, response);
                        rd = getServletContext().getRequestDispatcher("/UploadView.jsp");
                        rd.include(request, response);
                        rd = getServletContext().getRequestDispatcher("/footer.jsp");
                        rd.include(request, response);
                    }else{ // berhasil
                        session.setAttribute("bean", bean);
                        response.sendRedirect("/ListContentPage");
    //                    rd = getServletContext().getRequestDispatcher("/ListContentPage?");
    //                    rd.forward(request, response);
                        //$this->redirect(BASE_URL.'content_con/list_content/-1/-1/-1/1');

                    }

            }else{
                session.setAttribute("bean", bean);
                rd = getServletContext().getRequestDispatcher("/header.jsp");
                rd.include(request, response);
                rd = getServletContext().getRequestDispatcher("/UploadView.jsp");
                rd.include(request, response);
                rd = getServletContext().getRequestDispatcher("/footer.jsp");
                rd.include(request, response);
            }
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