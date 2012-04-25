package Controller;

import java.io.IOException;

import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import javax.servlet.http.HttpSession;
import Model.ContentModel;
import javax.servlet.RequestDispatcher;
import Model.Model;
import Model.MySQLConnect;
import Model.QueryResult;
import java.util.ArrayList;

//@WebServlet(name = "ContentCon", urlPatterns = {"/ContentCon"})
public class SearchPageCon extends HttpServlet {

    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.setContentType("text/html;charset=UTF-8");
        
        
        Model bean = new Model();
        String search = "";  //search input
        String filter = "";  //search option
        ArrayList<content> search_result = new ArrayList<content>();
        ArrayList<content> konten = new ArrayList<content>();
        ArrayList<content> result = new ArrayList<content>();
        
        if(!search.isEmpty() && filter.isEmpty() && (search.length() < 45)){
                if(filter.equals("filter-none")){
                    QueryResult query = MySQLConnect.query("select * from user");
                    ArrayList<content> result_user = new ArrayList<content>();
                    ArrayList<content> result_konten = new ArrayList<content>();
                    result_user = filterUser(query,search);
                    search_result = result_user;
                    konten = getContent();
                    
                    result_konten = filterContent(konten,search);
                    int i = 0;
                    while (result_konten.isEmpty()){
                        //lakukan proses for each
                    }
                    search_result = result;
                }
                else if(filter.equals("filter-user")){
                    QueryResult query = MySQLConnect.query("select * from user");
                    result = filterUser(query, search);
                    search_result = result;
                }
                else if(filter.equals("filter-cont")){
                    konten = getContent();
                    result = filterContent(konten, search);
                    search_result = result;
                }
                RequestDispatcher rd;
                rd = getServletContext().getRequestDispatcher("/header.jsp");
                rd.include(request, response);
                rd = getServletContext().getRequestDispatcher("/SearchView.jsp");
                rd.include(request, response);
                rd = getServletContext().getRequestDispatcher("/footer.jsp");
                rd.include(request, response);
            }else{
                response.sendRedirect("BASE_URL"+"home_con/");
            }
        
    }//
    
    public ArrayList<content> filterUser(QueryResult qr, String search){
        ArrayList<content> result = new ArrayList<content>();
        QueryResult tempUser = qr;
        int counter = 0;
        String filter = search.toLowerCase();
        for(int i=0;i<qr.count();i++){
            //tempUser. = "user";
        }
        return result;
    }
    
    public ArrayList<content> filterContent(ArrayList<content> content, String search){
        ArrayList<content> result = new ArrayList<content>();
        
        return result;
    }
    
    public boolean exitUser(QueryResult user, String id){
        boolean found=false;
        int counter = 0;
        
        while((!found)&&(counter<user.count())){
            //if($user[$counter]['ID_USER']==$id)){
                found=true;
            //}
            counter++;
        }
        
        return found;
    }
    
    public ArrayList<content> getContent(){
        ArrayList<content> result = new ArrayList<content>();
        QueryResult konten = MySQLConnect.query("select * from konten natural join user");
        
        if(konten.count()>0){
            for(int i=0;i<konten.count();i++){
                int sum_like = 0;
                int sum_dislike = 0;
                
                //cari konten_like
                //like/dislike
                //$konten_like = $this->_model->query('select * from like_dislike where ID_KONTEN='.$konten[$i]['ID_KONTEN'].'');
                QueryResult konten_like = null;
                for(int j=0;j<konten_like.count();j++){
                    //if($konten_like[$j]['STATUS']=="LIKE") sum_like+=1;
                    //if($konten_like[$j]['STATUS']=="DISLIKE") sum_dislike+=1;
                }
                //user_like
                /*if(!empty($_SESSION['id'])){
                    $user_like = $this->_model->query('select * from like_dislike where ID_KONTEN='.$konten[$i]['ID_KONTEN'].' AND ID_USER='.$_SESSION['id'].'');
                    if(count($user_like)>0){
                    //echo 'asd';
                        $konten[$i]['STATUS_USER']=$user_like[0]['STATUS'];
                    }
                }*/
                //komentar
                QueryResult komen = MySQLConnect.query("select * from komentar where ID_KONTEN=" + "$konten[$i]['ID_KONTEN']");
                /*$konten[$i]['KOMENTAR'] = $komen;

                $konten[$i]['LIKE'] = $sum_like-$sum_dislike;*/
                
                //tag
                QueryResult tag = MySQLConnect.query("select * from konten_tag natural join tag where konten_tag.ID_KONTEN=" + ".$konten[$i]['ID_KONTEN'].");
                //$konten[$i]['TAG'] = $tag;
            }
        }
       // result = konten;
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