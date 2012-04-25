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
import Model.QueryResult;
import java.io.PrintWriter;
import javax.servlet.RequestDispatcher;

//@WebServlet(name = "ContentCon", urlPatterns = {"/ContentCon"})
public class ListContentPageCon extends HttpServlet {

protected void processRequest(HttpServletRequest request, HttpServletResponse response)
throws ServletException, IOException {
response.setContentType("text/html;charset=UTF-8");
Model bean = new Model();
RequestDispatcher rd;
bean.display.put("title", "Payless Project Content");
PrintWriter out = response.getWriter();

//$this->setListAchievement();
if(request.getParameter("submit_tag")!=null){ // get
    if(request.getParameter("input_tag")==null){ // post
        //$this->redirect(BASE_URL.'content_con');
        out.println("redirect");
    }else{
        String input = request.getParameter("input_tag");
        String sort="-1";
        //String tag = explodeTag(input);
        //$this->set('input_tag_from_text', $input);
        
//                    if(count($tag)>0){
//                    $query='select * from konten_tag natural join tag where NAMA_TAG=';
//                    for($i=0;$i<count($tag);$i++){
//                        $query.='"'.$tag[$i].'"';
//                        if(($i+1)!=count($tag)){
//                            $query.=' OR NAMA_TAG=';
//                        }
//                    }
//                    $this->set('current_list_tag', $tag);
//                    //echo $query.'<br>';
//                    $tag_konten = $this->_model->query($query);            
//                    //echo count($tag_konten);
//                    $konten = $this->getContentFromMoreTag($tag_konten);
                    //for($i=0;$i<count($konten);$i++){
                        //echo $konten[$i]['JUDUL']."<br>";
                    //}

        QueryResult list_tag = MySQLConnect.query("select * from tag");
        if(list_tag.count()>0){
            bean.display.put("list_tag", list_tag);
        }
        if(request.getParameter("sortmethod")==null){ // sort waktu
            //$konten=  $this->orderKontenByTime($konten);
            //sort="-1";
        }else if(request.getParameter("sortmethod").equals("1")){ // sort like
            //$konten=  $this->orderKontenByLike($konten);
            sort="1";
        }else if(request.getParameter("sortmethod").equals("2")){ // sort komentar
            //$konten=  $this->orderKontenByKomentar($konten);                    
            sort="2";
        }else if(request.getParameter("sortmethod").equals("3")){ // sort view
            //$konten=  $this->orderKontenByView($konten);                    
            sort="3";
        }
        bean.display.put("current_sort", sort);
        //$this->set('konten',$konten);
        HttpSession session = request.getSession(true);
        session.setAttribute("bean", bean);
        rd =getServletContext().getRequestDispatcher("/header.jsp");
        rd.include(request, response);
        rd =getServletContext().getRequestDispatcher("/ListContentView.jsp");
        rd.include(request, response);
        rd =getServletContext().getRequestDispatcher("/footer.jsp");
        rd.include(request, response);
    }                
}else{
    String sort="-1";
    
//                if($achieve!=-1){
//                    $this->checkFirstPost();
//                    $this->checkMorePost();
//                    $this->checkThreeAchievement();
//                    $this->checkUltimate();
//                }

    QueryResult list_tag = MySQLConnect.query("select * from tag");
    if(list_tag.count()>0){
        bean.display.put("list_tag", list_tag);
    }
    String id_tag="-1";
    if(request.getParameter("id_tag")==null){
        //id_tag = "-1";
    }else id_tag = request.getParameter("id_tag"); 
    QueryResult current_list_tag = MySQLConnect.query("select * from tag where ID_TAG="+ id_tag);
    if(current_list_tag!=null && current_list_tag.count()>0){
        String[] clt = new String[0];
        clt[0] = current_list_tag.get(0, "NAMA_TAG");
        bean.display.put("current_list_tag", clt);
    }
    if(id_tag.equals("-1")){
    //    $konten= $this->getContent();   
    }else{
//    $konten = $this->getContentFromTag($id_tag);                
        
    }
    if(sort.equals("-1")){
//    $konten=  $this->orderKontenByTime($konten);
    }else if(sort.equals("1")){ // sort like
//    $konten=  $this->orderKontenByLike($konten);
    }else if(sort.equals("2")){ // sort komentar
//    $konten=  $this->orderKontenByKomentar($konten);                    
    }else if(sort.equals("3")){ // sort view
//    $konten=  $this->orderKontenByView($konten);                    
    }
    
    bean.display.put("current_sort", sort);
    bean.display.put("current_tag", id_tag);
    //bean.display.put("konten", konten);
    bean.display.put("gate", 1);
    bean.display.put("title_page", "Contents");
    
    HttpSession session = request.getSession(true);
    session.setAttribute("bean", bean);
    rd =getServletContext().getRequestDispatcher("/header.jsp");
    rd.include(request, response);
    rd =getServletContext().getRequestDispatcher("/ListContentView.jsp");
    rd.include(request, response);
    rd =getServletContext().getRequestDispatcher("/footer.jsp");
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