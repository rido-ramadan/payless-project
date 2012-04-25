package Controller;

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
        bean.display.put("title", new String[]{"asep", "dayat"});
        getContent(request); 
//        bean.display.put("konten", new ArrayList<String>());
//        ArrayList<String> a = (ArrayList<String>)bean.display.get("konten");
//        System.out.println("a ukuran="+a.size());
//        a.add("woi");
//        ArrayList<String> b = (ArrayList<String>)bean.display.get("konten");
//        System.out.println("b ukuran="+b.size());
        QueryResult query = MySQLConnect.query("select * from konten");
        if (query.count() > 0) {
            bean.display.put("content_most_like", query);
            bean.display.put("content_most_comment", query);
        }

        HttpSession session = request.getSession(true);
        session.setAttribute("bean", bean);

        RequestDispatcher rd;
        rd = getServletContext().getRequestDispatcher("/header.jsp");
        rd.include(request, response);
        rd = getServletContext().getRequestDispatcher("/HomeView.jsp");
        rd.include(request, response);
        rd = getServletContext().getRequestDispatcher("/footer.jsp");
        rd.include(request, response);
    }//

    public Model getContent(HttpServletRequest request) {
        Model  result= new Model();
        QueryResult konten = MySQLConnect.query("select * from konten natural join user");
        result = konten.getModel();
        System.out.println((Integer)result.display.get("isi.count()"));
        if((Integer)result.display.get("isi.count()") >0){
            for(int i=0;i<konten.count();i++){
                int sum_like = 0;
                int sum_dislike = 0;
                //like/dislike
                QueryResult konten_like = MySQLConnect.query("select * from like_dislike where ID_KONTEN="+result.get(i, "ID_KONTEN") +"");
                for(int j=0;j<konten_like.count();j++){
                    if(konten_like.get(j, "STATUS").equals("LIKE")) sum_like+=1;
                    if(konten_like.get(j, "STATUS").equals("DISLIKE")) sum_dislike+=1;
                }
                //echo "like=".$sum_like."<br>";
                //echo "dislike=".$sum_dislike."<br>";

                //user like
                HttpSession session = request.getSession(true);
                User user = (User)session.getAttribute("user");
                if(user!=null){
                    QueryResult user_like = MySQLConnect.query("select * from like_dislike where ID_KONTEN="+konten.get(i, "ID_KONTEN") +" AND ID_USER="+user.ID_User+"");
//                    System.out.println("user like="+user_like.count());
//                    System.out.println("id user="+user.ID_User);
//                    System.out.println("id konten="+konten.get(i, "ID_KONTEN") );
                    if(user_like.count()>0){
                    //echo 'asd';
                        //konten.get(i, "STATUS_USER") = 
                        Model bean = new Model();
//                        bean.display.put("konten", bean)
//                        $konten[$i]['STATUS_USER']=$user_like[0]['STATUS'];
                        result.put(i, "STATUS_USER", user_like.get(0, "STATUS"));
                        //System.out.println("status = "+result.get(i, "STATUS_USER"));
                    }
                }else System.out.println("user null");
//                //komentar
                QueryResult komen = MySQLConnect.query("select * from komentar where ID_KONTEN="+result.get(i, "ID_KONTEN"));
//                result.put("i", "KOMENTAR", komen.getModel());
//                $konten[$i]['KOMENTAR'] = $komen;
//
//                $konten[$i]['LIKE'] = $sum_like-$sum_dislike;
//                // tag
//                $tag = $this->_model->query('select * from konten_tag natural join tag where konten_tag.ID_KONTEN="'.$konten[$i]['ID_KONTEN'].'"');
//                $konten[$i]['TAG'] = $tag;

            }
//            $result = $konten;
        }
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