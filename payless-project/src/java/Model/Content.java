/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package Model;

import java.util.Date;

/**
 *
 * @author Edgar Drake
 */
public class Content {
    String judul;
    String link;
    String deskripsi;
    String username;
    String password;
    String nama;
    String tgl_lahir;
    String email;
    String avatar;
    String gender;
    String about_me;
    String status;
    String id_user;
    String id_konten;
    String id_type;
    String waktu;
    String status_user;
    String[] komentar;
    String[] tag;
    String[] id_user_komentar;
    String[] waktu_komentar;
    int like;

    public int getLike() {
        return like;
    }

    public void setLike(int like) {
        this.like = like;
    }
    

    public String[] getWaktu_komentar() {
        return waktu_komentar;
    }

    public void setWaktu_komentar(String[] waktu_komentar) {
        this.waktu_komentar = waktu_komentar;
    }
    
    
    public String[] getId_user_komentar() {
        return id_user_komentar;
    }

    public void setId_user_komentar(String[] id_user_komentar) {
        this.id_user_komentar = id_user_komentar;
    }
    
    
    public Content(){
        
    }
    public String getAbout_me() {
        return about_me;
    }

    public void setAbout_me(String about_me) {
        this.about_me = about_me;
    }

    public String getAvatar() {
        return avatar;
    }

    public void setAvatar(String avatar) {
        this.avatar = avatar;
    }

    public String getDeskripsi() {
        return deskripsi;
    }

    public void setDeskripsi(String deskripsi) {
        this.deskripsi = deskripsi;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getGender() {
        return gender;
    }

    public void setGender(String gender) {
        this.gender = gender;
    }

    public String getId_konten() {
        return id_konten;
    }

    public void setId_konten(String id_konten) {
        this.id_konten = id_konten;
    }

    public String getId_type() {
        return id_type;
    }

    public void setId_type(String id_type) {
        this.id_type = id_type;
    }

    public String getId_user() {
        return id_user;
    }

    public void setId_user(String id_user) {
        this.id_user = id_user;
    }

    public String getJudul() {
        return judul;
    }

    public void setJudul(String judul) {
        this.judul = judul;
    }

    public String[] getKomentar() {
        return komentar;
    }

    public void setKomentar(String[] komentar) {
        this.komentar = komentar;
    }

    public String getLink() {
        return link;
    }

    public void setLink(String link) {
        this.link = link;
    }

    public String getNama() {
        return nama;
    }

    public void setNama(String nama) {
        this.nama = nama;
    }

    public String getPassword() {
        return password;
    }

    public void setPassword(String password) {
        this.password = password;
    }

    public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }

    public String getStatus_user() {
        return status_user;
    }

    public void setStatus_user(String status_user) {
        this.status_user = status_user;
    }

    public String[] getTag() {
        return tag;
    }

    public void setTag(String[] tag) {
        this.tag = tag;
    }

    public String getTgl_lahir() {
        return tgl_lahir;
    }

    public void setTgl_lahir(String tgl_lahir) {
        this.tgl_lahir = tgl_lahir;
    }

    public String getUsername() {
        return username;
    }

    public void setUsername(String username) {
        this.username = username;
    }

    public String getWaktu() {
        return waktu;
    }

    public void setWaktu(String waktu) {
        this.waktu = waktu;
    }
    
    
}
