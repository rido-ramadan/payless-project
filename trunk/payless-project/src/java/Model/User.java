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
public class User {
    public int ID_User;
    public String username;
    public String password;
    public String name;
    public Date birthdate;
    public String email;
    public String avatar;
    public String gender;
    public String aboutMe;
    public String status;
    public boolean valid;
    
    public User() {}

    public User(int ID, String username, String password, String name,
                Date date, String email, String avatar, String gender,
                String aboutMe, String status) {
        this.ID_User = ID;
        this.username = username;
        this.password = password;
        this.name = name;
        this.birthdate = date;
        this.email = email;
        this.avatar = avatar;
        this.gender = gender;
        this.aboutMe = aboutMe;
        this.status = status;
    }

    public int getID_User() {
        return ID_User;
    }

    public void setID_User(int ID_User) {
        this.ID_User = ID_User;
    }

    public String getAboutMe() {
        return aboutMe;
    }

    public void setAboutMe(String aboutMe) {
        this.aboutMe = aboutMe;
    }

    public String getAvatar() {
        return avatar;
    }

    public void setAvatar(String avatar) {
        this.avatar = avatar;
    }

    public Date getBirthdate() {
        return birthdate;
    }

    public void setBirthdate(Date birthdate) {
        this.birthdate = birthdate;
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

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
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

    public String getUsername() {
        return username;
    }

    public void setUsername(String username) {
        this.username = username;
    }
    
    public boolean isValid() {
        return valid;
    }

    public void setValid(boolean valid) {
        this.valid = valid;
    }
}
