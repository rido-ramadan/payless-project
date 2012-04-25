package Controller.Content;

import Model.Constant;
import Model.Content;
import java.io.IOException;

import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import javax.servlet.http.HttpSession;
import Model.Model;
import Model.MySQLConnect;
import Model.QueryResult;
import Model.User;
import java.util.ArrayList;
import javax.servlet.RequestDispatcher;

//@WebServlet(name = "ContentCon", urlPatterns = {"/ContentCon"})
public class ContentPageCon extends HttpServlet {

    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.setContentType("text/html;charset=UTF-8");
        RequestDispatcher rd;
        HttpSession session = request.getSession(true);
        Model bean = new Model();
        User user = ((User)session.getAttribute("user"));
        if (session.getAttribute("login") != null) {
            
            QueryResult message = MySQLConnect.query("select * from message inner join user on message.ID_FROM=user.ID_USER where ID_TO=" + session.getAttribute("id"));
            if (message != null && message.count() > 0) {
                bean.display.put("message_box", message);
            }
            
            if (request.getParameter("id") != null) {
                System.out.println("Artikel ID: " + request.getParameter("id"));
                System.out.println("User ID: " + user.getID_User());
                QueryResult viewed = MySQLConnect.query("select * from konten_view where ID_KONTEN=" + request.getParameter("id") + " AND ID_USER=" + user.getID_User());
                System.out.println(viewed.get(0, "ID_KONTEN"));
                System.out.println(viewed.get(0, "ID_USER"));
                if (viewed.count() <= 0) {
                    if (MySQLConnect.sQuery("insert into konten_view (ID_KONTEN, ID_USER) values (" + request.getParameter("id") + ", " + user.getID_User() + ")")) {
                        
                    } else { // gagal
                        
                    }
                }

            }
        }

        //            $this->setListAchievement();

        String ID = request.getParameter("id");
        if (ID != null) {
//            if($achieve!=-1){
//                $this->checkFirstComment();
//                $this->checkMoreComment();
//            }
            Content konten = getContentFromId(Constant.getContent(user),Integer.parseInt(ID));
            if(konten!=null){
                QueryResult komen = MySQLConnect.query("select * from komentar natural join user where ID_KONTEN="+konten.getId_konten()+" order by WAKTU desc");
                String[] idUserKomen = new String[komen.count()];
                String[] contentUserKomen = new String[komen.count()];
                String[] waktuUserKomen = new String[komen.count()];
                for(int j=0;j<komen.count();j++){
                    idUserKomen[j] = komen.get(j, "ID_USER");
                    contentUserKomen[j] = komen.get(j, "KOMENTAR");
                    waktuUserKomen[j] = komen.get(j, "wAKTU");                    
                }
                konten.setKomentar(contentUserKomen);
                konten.setId_user_komentar(idUserKomen);
                konten.setWaktu_komentar(waktuUserKomen);
                bean.display.put("content", konten);
                System.out.println("konent exist");
            }else System.out.println("konten exist");
        }
        session.setAttribute("bean", bean);
        //            if(!empty($id)){
        //                if($achieve!=-1){
        //                    $this->checkFirstComment();
        //                    $this->checkMoreComment();
        //                }
        //                $konten = $this->getContentFromId($this->getContent(),$id);
        //                if(!empty($konten)){
        //                    if($konten!=null){
        //                        $komentar = $this->_model->query('select * from komentar natural join user where ID_KONTEN='.$konten['ID_KONTEN'].' order by WAKTU desc');
        //                        $konten['KOMENTAR'] = $komentar;
        //                        $this->set('content',$konten);
        //                        $this->loadView("header_view.php");
        //                        $this->loadView("content_view.php");		
        //                        $this->loadView("footer_view.php");            					
        //                    }
        //                }
        //            }else{
        //                
        //            }

        rd = getServletContext().getRequestDispatcher("/header.jsp");
        rd.include(request, response);
        rd = getServletContext().getRequestDispatcher("/ContentView.jsp");
        rd.include(request, response);
        rd = getServletContext().getRequestDispatcher("/footer.jsp");
        rd.include(request, response);
    }//
    public Content getContentFromId(ArrayList<Content> konten, int id){
        Content result = null;
        int counter=0;
        if(konten.size()>0)
        while(counter<konten.size() && result==null){
            if(Integer.parseInt(konten.get(counter).getId_konten())==id) result = konten.get(counter);
            counter+=1;
        }
        return result;        
    }
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