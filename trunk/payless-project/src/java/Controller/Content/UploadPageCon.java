package Controller.Content;

import java.io.IOException;

import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import javax.servlet.http.HttpSession;
import Model.ContentModel;
import Model.Model;
import Model.MySQLConnect;
import java.io.File;
import java.util.Iterator;
import java.util.List;
import javax.servlet.RequestDispatcher;
import org.apache.commons.fileupload.DiskFileUpload;
import org.apache.commons.fileupload.FileItem;
import org.apache.commons.fileupload.FileUpload;

public class UploadPageCon extends HttpServlet {

    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.setContentType("text/html;charset=UTF-8");
        RequestDispatcher rd;
        Model bean = new Model();
        HttpSession session = request.getSession(true);
        
        if(request.getParameter("uploading")!=null){ // upload process
            if(session.getAttribute("login")==null){
                // kosong
            }else{
                String title=null, description=null,  tags=null,link_input=null, type=null, image=null;
                
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
                        }else if(name.equals("type")){
                            type = value;
                        }
                        else if(name.equals("link-input")){
                            link_input=value;
                        }
                        else if(name.equals("description")){
                            description=value;
                        }
                        else if(name.equals("tags")){
                            tags=value;
                        }
                        System.out.println("test " + value);
                    } else {
                        File fullFile = new File(item.getName());
                        System.out.println("File Lengkap : " + fullFile.getName());
                        image = fullFile.getName();
                        String sPath = getServletConfig().getServletContext().getRealPath("/file_uploaded");
                        System.out.println("Lokasi penyimpanan file =" + sPath);

                        savedFile = new File(sPath, fullFile.getName());

                        try {
                            item.write(savedFile);
                        } catch (Exception e) {
                            System.out.println("Ada Kesalahan ketika menyimpan File :" + e.getMessage());
                        }
                    }
                }            
                
                boolean valid= false;
                if(type!=null)
                    bean.display.put("radio_click",type);
                if(title==null){
                    bean.display.put("empty", "title");
                }else{
                    bean.display.put("post_title", title);
                    if(title.equals("Link")){
                        if(link_input!=null){
                            bean.display.put("post_link", link_input);
                            if(valudUrl){
                                if(description!=null){
                                    // sukses
                                    valid = true;
                                    String id_user = (String) session.getAttribute("user");
                                    int id_type = 1;
                                    String waktu = date("Y-m-d H:i:s");
                                    String judul = title;
                                    String link = link_input;
                                    String desc = description;
                                    String insert = "insert into konten (ID_USER, ID_TYPE, WAKTU, JUDUL, LINK, DESKRIPSI) "
                                            + "values (\""+id_user+"\", \""+id_type+"\","
                                            + "\""+waktu+"\", \""+judul+"\","
                                            + " \""+link+"\", \""+desc+"\")";
                                    if(MySQLConnect.sQuery(insert)){
                                        
                                    }
                                    $this->input_tags_in_last_konten($_POST['tags']);
                                }
                                else{
                                    if(description==null){
                                        bean.display.put("empty", "description");
                                    }
                                }                                
                            }
                        }else{
                            //echo 'tidak valid';
                        }
                    }
//                    else if($_POST['type']=="Image"){
//                        if(!empty($_FILES['picture']['name'])){
//                            if($_FILES['picture']['type']!='image/jpg' && 
//                                $_FILES['picture']['type']!='image/jpeg' && 
//                                $_FILES['picture']['type']!='image/pjpeg'){ 
//                                $this->set('empty','image');
//                                }else{
//                                    $valid=true;
//
//                                    $fileName = $_FILES['picture']['name']; //get the file name
//                                    $fileSize = $_FILES['picture']['size']; //get the size
//                                    $fileError = $_FILES['picture']['error']; //get the error when upload
//                                    if($fileSize > 0 || $fileError == 0){ //check if the file is corrupt or error
//                                    $move = move_uploaded_file($_FILES['picture']['tmp_name'], 'image/'.$fileName); //save image to the folder
//                                    if($move){
//                                        $valid = true;
//                                        $id_user = $_SESSION['id'];
//                                        $id_type = 2;
//                                        $waktu = date("Y-m-d H:i:s");
//                                        $judul = $_POST['title'];
//                                        $link = $fileName;
//                                        $desc = "";
//                                        $insert = 'insert into konten (ID_USER, ID_TYPE, WAKTU, JUDUL, LINK, DESKRIPSI) 
//                                            values ("'.$id_user.'", "'.$id_type.'",
//                                                "'.$waktu.'", "'.$judul.'",
//                                                    "'.$link.'", "'.$desc.'"
//                                                )';
//                                        $this->_model->query($insert);
//                                        $this->input_tags_in_last_konten($_POST['tags']);
//
//                                    } else{
//                                        //echo "<h3>Failed! </h3>";
//                                    }
//                                    } else {
//                                        //echo "Failed to Upload : ".$fileError;
//                                    }      
//                                }
//
//                        }
//                        else{
//                            $this->set('empty','image');
//                        }
//                    }

                }
            }
        }else{
            rd = getServletContext().getRequestDispatcher("/header.jsp");
            rd.include(request, response);
            rd = getServletContext().getRequestDispatcher("/UploadView.jsp");
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