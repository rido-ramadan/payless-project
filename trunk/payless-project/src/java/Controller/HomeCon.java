package Controller;

import Model.Constant;
import Model.Content;
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
import Model.User;
import java.io.PrintWriter;
import java.util.ArrayList;
import java.util.HashMap;
import javax.servlet.RequestDispatcher;

//@WebServlet(name = "ContentCon", urlPatterns = {"/ContentCon"})
public class HomeCon extends HttpServlet {

    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.setContentType("text/html;charset=UTF-8");
        
//    if(!empty($_SESSION['login'])){
//            $achievement = $this->_model->query('select * from user_achievement natural join achievement where ID_USER='.$_SESSION['id'].'');            
//            if(count($achievement)>0){
//                $this->set('list_achievement', $achievement);
//            }
//            $message = $this->_model->query('select * from message inner join user on message.ID_FROM=user.ID_USER where ID_TO='.$_SESSION['id'].'');
//            if(count($message)>0){
//                $this->set('message_box', $message);
//            }
//        }
//        $list_tag = $this->_model->query('select * from tag');
//        if(count($list_tag)>0){
//                $this->set('list_tag',$list_tag);
//        }
//                //for($i=0;$i<count($list_tag);$i++)
//                        //echo $list_tag[$i]['NAMA_TAG'];
//        $konten = $this->_model->query('select * from konten');
//        //echo count($konten);
//        if(count($konten)>0){
//            $konten = $this->getContent();
//            $this->set('content_most_like',$this->orderKontenByLike($konten));
//            $this->set('content_most_comment',$this->orderKontenByKomentar($konten));
//        }

        //$this->set('title_page', 'Homepage');
        Model bean = new Model();
        HttpSession session = request.getSession(true);

        bean.display.put("title", "Payless Project");
        User user = (User)session.getAttribute("user");
        ArrayList<Content> content = Constant.getContent(user); 
        QueryResult query = MySQLConnect.query("select * from konten");
        if (query.count() > 0) {
            ArrayList<Content> like = orderKontenByLike(content);
            ArrayList<Content> comment = orderKontenByComment(content);
            bean.display.put("content_most_like", like);
            bean.display.put("content_most_comment", comment);
        }
        

        session.setAttribute("bean", bean);

        RequestDispatcher rd;
        rd = getServletContext().getRequestDispatcher("/header.jsp");
        rd.include(request, response);
        rd = getServletContext().getRequestDispatcher("/HomeView.jsp");
        rd.include(request, response);
        rd = getServletContext().getRequestDispatcher("/footer.jsp");
        rd.include(request, response);
    }//
    

        
    public ArrayList<Content> orderKontenByLike(ArrayList<Content> konten){
        ArrayList<Content> result = new ArrayList<Content>();
        ArrayList<Content> temp = new ArrayList<Content>();
        for(int i=0;i<konten.size();i++){
            temp.add(konten.get(i));
        }
        if(konten.size()>0){
            int id = Constant.getMaxLike(temp);
            result.add(temp.get(id));
            temp.remove(id);
        }
        //System.out.println(id);
        if(konten.size()>1){
        int id = Constant.getMaxLike(temp);
        result.add(temp.get(id));
        temp.remove(id);
        }
        //System.out.println(id);
        if(konten.size()>2){
        int id = Constant.getMaxLike(temp);
        result.add(temp.get(id));
        temp.remove(id);
        }
        //System.out.println(id);
        return result;
    }
    
    public ArrayList<Content> orderKontenByComment(ArrayList<Content> konten){
        ArrayList<Content> result = new ArrayList<Content>();
        ArrayList<Content> temp = new ArrayList<Content>();
        for(int i=0;i<konten.size();i++){
            temp.add(konten.get(i));
        }
        
        if(konten.size()>0){
            int id = Constant.getMaxComment(temp);
            result.add(temp.get(id));
            temp.remove(id);
        }
        //System.out.println(id);
        if(konten.size()>1){
        int id = Constant.getMaxComment(temp);
        result.add(temp.get(id));
        temp.remove(id);
        }
        //System.out.println(id);
        if(konten.size()>2){
        int id = Constant.getMaxComment(temp);
        result.add(temp.get(id));
        temp.remove(id);
        }
        //System.out.println(id);
        return result;
    }

// <editor-fold defaultstate="collapsed" desc="HttpServlet methods. Click on the +sign on the left to edit the code.">

    /**
     * Handles the HTTP <code>GET</code> method.
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
     * Handles the HTTP <code>POST</code> method.
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