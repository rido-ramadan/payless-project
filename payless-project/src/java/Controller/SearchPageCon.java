package Controller;

import Model.*;
import java.io.IOException;

import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import javax.servlet.http.HttpSession;
import javax.servlet.RequestDispatcher;
import java.io.PrintWriter;
import java.util.ArrayList;

//@WebServlet(name = "ContentCon", urlPatterns = {"/ContentCon"})
public class SearchPageCon extends HttpServlet {

    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.setContentType("text/html;charset=UTF-8");
        PrintWriter out = response.getWriter();
        try {
            Model bean = new Model();
            String search;  //search input
            String filter;  //search option
            ArrayList<Content> search_result = new ArrayList<Content>();
            ArrayList<Content> konten = new ArrayList<Content>();
            ArrayList<Content> result = new ArrayList<Content>();

            search = request.getParameter("search_input");
            filter = request.getParameter("srch_op");
            System.out.println("Search for: " + search + ", " + filter);

            if (search != null && filter != null && (search.length() < 45)) {
                if (filter.equals("filter-none")) {
                    QueryResult query = MySQLConnect.query("select * from user");

//                    ArrayList<Content> result_user = new ArrayList<Content>();
//                    ArrayList<Content> result_konten = new ArrayList<Content>();
//                    result_user = filterUser(query, search);
//                    search_result = result_user;
//                    HttpSession session = request.getSession(true);
//                    User currentUser = ((User) session.getAttribute("user"));
//                    konten = Constant.getContent(currentUser);
//
//                    result_konten = filterContent(konten, search);
//                    while (!result_konten.isEmpty()) {
//                        for (content value : result_konten) {
//                            result.add(value);
//                            result_konten.remove(0);
//                        }
//                    }
//
//                    search_result = result;
//                } else if (filter.equals("filter-user")) {
//                    QueryResult query = MySQLConnect.query("select * from user");
//                    result = filterUser(query, search);
//                    search_result = result;
//                } else if (filter.equals("filter-cont")) {
//                    konten = getContent();
//                    result = filterContent(konten, search);
//                    search_result = result;
//                }

                    RequestDispatcher rd;
                    rd = getServletContext().getRequestDispatcher("/header.jsp");
                    rd.include(request, response);
                    rd = getServletContext().getRequestDispatcher("/SearchView.jsp");
                    rd.include(request, response);
                    rd = getServletContext().getRequestDispatcher("/footer.jsp");
                    rd.include(request, response);
                } else {
                    response.sendRedirect("/Home");
                }
            }
        } finally {
            out.close();
        }
    }//

    public ArrayList<Content> filterUser(QueryResult qr, String search, HttpServletResponse response) {
        ArrayList<Content> result = new ArrayList<Content>();
        int counter = 0;
        String filter = search.toLowerCase();
        try {
            PrintWriter out = response.getWriter();
            for (int i = 0; i < qr.count(); i++) {
                out.println(qr.get(i, "NAMA") + " :<br/>");
                out.println(qr.get(i, "NAMA").indexOf(filter) + "<br/>");
                String useThis = qr.get(i, "JENIS");
                useThis = "user";

//                if (qr.get(i, "NAMA").toLowerCase().indexOf(filter) != false)
            }
        } catch (Exception e) {
        }
        return result;
//        for($i=0;$i<count($user);$i++){
//            $user[$i]['JENIS'] = 'user';
//            if(strpos(strtolower($user[$i]['NAMA']), $filter)!==false){
//                //echo $user[$i]['NAMA'].' ada<br>';
//                
//                if(!$this->existUser($result, $user[$i]['ID_USER'])){
//                    $result[$counter] = $user[$i];
//                    $result[$counter]['JENIS'] = 'user';
////                    echo $user[$i]['NAMA'].'<br>';
//                    $counter+=1;
//                }
//            }else if(strpos(strtolower($user[$i]['EMAIL']), $filter)!==false){
//                if(!$this->existUser($result, $user[$i]['ID_USER'])){
//                    $result[$counter] = $user[$i];
//                    $result[$counter]['JENIS'] = 'user';
////                    echo $user[$i]['EMAIL'].'<br>';
//                    $counter+=1;
//                }
//            }else if(strpos(strtolower ($user[$i]['ABOUT_ME']), $filter)!==false){
//                if(!$this->existUser($result, $user[$i]['ID_USER'])){
//                    $result[$counter] = $user[$i];
//                    $result[$counter]['JENIS'] = 'user';
////                    echo $user[$i]['ABOUT_ME'].'<br>';
//                    $counter+=1;
//                }
//            }

    }

    public ArrayList<content> filterContent(ArrayList<content> content, String search) {
        ArrayList<content> result = new ArrayList<content>();

        return result;
    }

    public boolean exitUser(QueryResult user, String id) {
        boolean found = false;
        int counter = 0;

        while ((!found) && (counter < user.count())) {
            //if($user[$counter]['ID_USER']==$id)){
            found = true;
            //}
            counter++;
        }

        return found;
    }

    public ArrayList<content> getContent() {
        ArrayList<content> result = new ArrayList<content>();
        QueryResult konten = MySQLConnect.query("select * from konten natural join user");

        if (konten.count() > 0) {
            for (int i = 0; i < konten.count(); i++) {
                int sum_like = 0;
                int sum_dislike = 0;

                QueryResult konten_like = MySQLConnect.query("select * from like_dislike where ID_KONTEN=" + konten.get(i, "ID_KONTEN"));
                for (int j = 0; j < konten_like.count(); j++) {
                    if (konten_like.get(j, "STATUS").equals("LIKE")) {
                        sum_like++;
                    }
                    if (konten_like.get(j, "STATUS").equals("DISLIKE")) {
                        sum_dislike++;
                    }
                }
                //user_like
                /*
                 * if(!empty($_SESSION['id'])){ $user_like =
                 * $this->_model->query('select * from like_dislike where
                 * ID_KONTEN='.$konten[$i]['ID_KONTEN'].' AND
                 * ID_USER='.$_SESSION['id'].''); if(count($user_like)>0){
                 * //echo 'asd';
                 * $konten[$i]['STATUS_USER']=$user_like[0]['STATUS']; } }
                 */
                //komentar
                QueryResult komen = MySQLConnect.query("select * from komentar where ID_KONTEN=" + "$konten[$i]['ID_KONTEN']");
                /*
                 * $konten[$i]['KOMENTAR'] = $komen;
                 *
                 * $konten[$i]['LIKE'] = $sum_like-$sum_dislike;
                 */

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