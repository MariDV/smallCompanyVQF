    // DATA VIEW ABAS PARA TROCA

    function changedbCustumer(){
        var cust= document.getElementById("cust");
        var address= document.getElementById("address");
        var bankinfo=document.getElementById("bank");
        var family= document.getElementById("family");
        var specialneed=document.getElementById("specialneed");
        var problemsV=document.getElementById("problem");
    
        if (cust.style.display ="none") {
            cust.style.display="block";
            document.getElementById("opCustomer").style.background="white";
            document.getElementById("Header_nameDataview").innerHTML = "Customers";
            address.style.display="none";
            document.getElementById("opAddress").style.background="lightgrey";
            bankinfo.style.display="none";
            document.getElementById("opBank").style.background="lightgrey";
            family.style.display="none";
            document.getElementById("opFamily").style.background="lightgrey";
            specialneed.style.display="none";
            document.getElementById("opSneeds").style.background="lightgrey";
            problemsV.style.display="none";
            document.getElementById("opProblem").style.background="lightgrey";

             }
    }
       
       function changedbAddress(){
        var cust= document.getElementById("cust");
        var address= document.getElementById("address");
        var bankinfo=document.getElementById("bank");
        var family= document.getElementById("family");
        var specialneed=document.getElementById("specialneed");
        var problemsV=document.getElementById("problem");
    
        if (address.style.display ="none") {
            address.style.display="block";
            document.getElementById("opAddress").style.background="white";
            document.getElementById("Header_nameDataview").innerHTML = "Address";
            cust.style.display="none";
            document.getElementById("opCustomer").style.background="lightgrey";
            bankinfo.style.display="none";
            document.getElementById("opBank").style.background="lightgrey";
            family.style.display="none";
            document.getElementById("opFamily").style.background="lightgrey";
            specialneed.style.display="none";
            document.getElementById("opSneeds").style.background="lightgrey";
            problemsV.style.display="none";
            document.getElementById("opProblem").style.background="lightgrey";

             }
       }

       function changedbBank(){
        var cust= document.getElementById("cust");
        var address= document.getElementById("address");
        var bankinfo=document.getElementById("bank");
        var family= document.getElementById("family");
        var specialneed=document.getElementById("specialneed");
        var problemsV=document.getElementById("problem");
    
        if (bankinfo.style.display ="none") {
            bankinfo.style.display="block";
            document.getElementById("opBank").style.background="white";
            document.getElementById("Header_nameDataview").innerHTML = "Bank Info";
            address.style.display="none";
            document.getElementById("opAddress").style.background="lightgrey";
            cust.style.display="none";
            document.getElementById("opCustomer").style.background="lightgrey";
            family.style.display="none";
            document.getElementById("opFamily").style.background="lightgrey";
            specialneed.style.display="none";
            document.getElementById("opSneeds").style.background="lightgrey";
            problemsV.style.display="none";
            document.getElementById("opProblem").style.background="lightgrey";
             }
       }

       function changedbFamily(){
        var cust= document.getElementById("cust");
        var address= document.getElementById("address");
        var bankinfo=document.getElementById("bank");
        var family= document.getElementById("family");
        var specialneed=document.getElementById("specialneed");
        var problemsV=document.getElementById("problem");
    
        if (family.style.display ="none") {
            family.style.display="block";
            document.getElementById("opFamily").style.background="white";
            document.getElementById("Header_nameDataview").innerHTML = "Address";
            cust.style.display="none";
            document.getElementById("opCustomer").style.background="lightgrey";
            bankinfo.style.display="none";
            document.getElementById("opBank").style.background="lightgrey";
            address.style.display="none";
            document.getElementById("opAddress").style.background="lightgrey";
            specialneed.style.display="none";
            document.getElementById("opSneeds").style.background="lightgrey";
            problemsV.style.display="none";
            document.getElementById("opProblem").style.background="lightgrey";

            }
       }

       function changedbSpecialNeeds(){
        var cust= document.getElementById("cust");
        var address= document.getElementById("address");
        var bankinfo=document.getElementById("bank");
        var family= document.getElementById("family");
        var specialneed=document.getElementById("specialneed");
        var problemsV=document.getElementById("problem");
    
        if (specialneed.style.display ="none") {
            specialneed.style.display="block";
            document.getElementById("opSneeds").style.background="white";
            document.getElementById("Header_nameDataview").innerHTML = "Special Needs";
            address.style.display="none";
            document.getElementById("opAddress").style.background="lightgrey";
            bankinfo.style.display="none";
            document.getElementById("opBank").style.background="lightgrey";
            family.style.display="none";
            document.getElementById("opFamily").style.background="lightgrey";
            cust.style.display="none";
            document.getElementById("opCustomer").style.background="lightgrey";
            problemsV.style.display="none";
            document.getElementById("opProblem").style.background="lightgrey";

            }
       }

       function changedbproblems(){
        var cust= document.getElementById("cust");
        var address= document.getElementById("address");
        var bankinfo=document.getElementById("bank");
        var family= document.getElementById("family");
        var specialneed=document.getElementById("specialneed");
        var problemsV=document.getElementById("problem");
    
        if (problemsV.style.display ="none") {
            problemsV.style.display="block";
            document.getElementById("opProblem").style.background="white";
            document.getElementById("Header_nameDataview").innerHTML = "Problems Report";
            address.style.display="none";
            document.getElementById("opAddress").style.background="lightgrey";
            bankinfo.style.display="none";
            document.getElementById("opBank").style.background="lightgrey";
            family.style.display="none";
            document.getElementById("opFamily").style.background="lightgrey";
            cust.style.display="none";
            document.getElementById("opCustomer").style.background="lightgrey";
            specialneed.style.display="none";
            document.getElementById("opSneeds").style.background="lightgrey";

            }
       }

    // FIM DATA VIEW ABAS PARA TROCA

   
    
    
    ///*CHANGE ABA`s OF THE CUSTOMERS INFOrMATION (PERSONAL INFO, SPECIAL NEEDS,ADDRESS and FAMILY)*/
    function changeinfo(){
        var page= document.getElementById("specialneeds");
        var ind= document.getElementById("personalinfo");
        var addr= document.getElementById("addressInput");
        var fam= document.getElementById("FamilyInfo");
        var acc= document.getElementById("BankAccCRUD");  
        var prm= document.getElementById("ProblemCRUD");
  
        if (page.style.display ="none") {
            page.style.display="inline-block";
            document.getElementById("specialneeds2").style.background="white";
            ind.style.display="none";
            document.getElementById("personalinfo1").style.background="lightgrey";
            addr.style.display="none";
            document.getElementById("addressInput3").style.background="lightgrey";
            fam.style.display="none";
            document.getElementById("FamilyInfo4").style.background="lightgrey";
            acc.style.display="none";
            document.getElementById("BankAccCRUD5").style.background="lightgrey";
            prm.style.display="none";
            document.getElementById("ProblemCustomer6").style.background="lightgrey";
             }
        var pic=document.getElementById("profilepic");
        if(pic.style.display=="none"){
            pic.style.display="inline-block";
        }
     }

    function changeback(){
        var page= document.getElementById("specialneeds");
        var ind= document.getElementById("personalinfo");
        var addr= document.getElementById("addressInput");
        var fam= document.getElementById("FamilyInfo");
        var acc= document.getElementById("BankAccCRUD");
        var prm= document.getElementById("ProblemCRUD");

        if (ind.style.display ="none") {
            ind.style.display="inline-block";
            document.getElementById("personalinfo1").style.background="white";
            page.style.display="none";
            document.getElementById("specialneeds2").style.background="lightgrey";
            addr.style.display="none";
            document.getElementById("addressInput3").style.background="lightgrey";
            fam.style.display="none";
            document.getElementById("FamilyInfo4").style.background="lightgrey";
            acc.style.display="none";
            document.getElementById("BankAccCRUD5").style.background="lightgrey";
            prm.style.display="none";
            document.getElementById("ProblemCustomer6").style.background="lightgrey";
            }
        var pic=document.getElementById("profilepic");
        if(pic.style.display=="none"){
            pic.style.display="inline-block";
        }
     }

    function changeAddress(){
        var page= document.getElementById("specialneeds");
        var ind= document.getElementById("personalinfo");
        var addr= document.getElementById("addressInput");
        var fam= document.getElementById("FamilyInfo");
        var acc= document.getElementById("BankAccCRUD");
        var prm= document.getElementById("ProblemCRUD");

        if (addr.style.display="none") {
            addr.style.display="inline-block";
            document.getElementById("addressInput3").style.background="white";
            page.style.display="none";
            document.getElementById("specialneeds2").style.background="lightgrey";
            ind.style.display="none";
            document.getElementById("personalinfo1").style.background="lightgrey";
            fam.style.display="none";
            document.getElementById("FamilyInfo4").style.background="lightgrey";
            acc.style.display="none"
            document.getElementById("BankAccCRUD5").style.background="lightgrey";
            prm.style.display="none";
            document.getElementById("ProblemCustomer6").style.background="lightgrey";
            }
        var pic=document.getElementById("profilepic");
        if(pic.style.display=="none"){
            pic.style.display="inline-block";
        }
    }

    function changeFamily(){
        var page= document.getElementById("specialneeds");
        var ind= document.getElementById("personalinfo");
        var addr= document.getElementById("addressInput");
        var fam= document.getElementById("FamilyInfo");
        var acc= document.getElementById("BankAccCRUD");
        var prm= document.getElementById("ProblemCRUD");

        if (fam.style.display="none") {
            fam.style.display="block";
            document.getElementById("FamilyInfo4").style.background="white";
            page.style.display="none";
            document.getElementById("specialneeds2").style.background="lightgrey";
            ind.style.display="none";
            document.getElementById("personalinfo1").style.background="lightgrey";
            addr.style.display="none";
            document.getElementById("addressInput3").style.background="lightgrey";
            acc.style.display="none";
            document.getElementById("BankAccCRUD5").style.background="lightgrey";
            prm.style.display="none";
            document.getElementById("ProblemCustomer6").style.background="lightgrey";
            }
            if (fam.style.display="inline-block") {
                fam.style.display="inline-block"
            }
        var pic=document.getElementById("profilepic");
        if(pic.style.display=="inline-block"){
        	pic.style.display="none";
        }
    }

    function changeBankAcc(){
        var page= document.getElementById("specialneeds");
        var ind= document.getElementById("personalinfo");
        var addr= document.getElementById("addressInput");
        var fam= document.getElementById("FamilyInfo");
        var acc= document.getElementById("BankAccCRUD");
        var prm= document.getElementById("ProblemCRUD");

        if (acc.style.display="none") {
            acc.style.display="block";
            document.getElementById("BankAccCRUD5").style.background="white";
            page.style.display="none";
            document.getElementById("specialneeds2").style.background="lightgrey";
            ind.style.display="none";
            document.getElementById("personalinfo1").style.background="lightgrey";
            addr.style.display="none";
            document.getElementById("addressInput3").style.background="lightgrey";
            fam.style.display="none";
            document.getElementById("FamilyInfo4").style.background="lightgrey";
            prm.style.display="none";
            document.getElementById("ProblemCustomer6").style.background="lightgrey";
            }
        var pic=document.getElementById("profilepic");
        if(pic.style.display=="inline-block"){
            pic.style.display="none";
        }
    }


        function changeProblem (){
        var page= document.getElementById("specialneeds");
        var ind= document.getElementById("personalinfo");
        var addr= document.getElementById("addressInput");
        var fam= document.getElementById("FamilyInfo");
        var acc= document.getElementById("BankAccCRUD");
        var prm= document.getElementById("ProblemCRUD");

        if (prm.style.display="none") {
            prm.style.display="block";
            document.getElementById("ProblemCustomer6").style.background="white";
            page.style.display="none";
            document.getElementById("specialneeds2").style.background="lightgrey";
            ind.style.display="none";
            document.getElementById("personalinfo1").style.background="lightgrey";
            addr.style.display="none";
            document.getElementById("addressInput3").style.background="lightgrey";
            fam.style.display="none";
            document.getElementById("FamilyInfo4").style.background="lightgrey";
            acc.style.display="none";
            document.getElementById("BankAccCRUD5").style.background="lightgrey";
            }
        var pic=document.getElementById("profilepic");
        if(pic.style.display=="inline-block"){
            pic.style.display="none";
        }
    }
    /*FINISH CHANGE ABA`s OF THE CUSTOMERS INFOrMATION (PERSONAL INFO, SPECIAL NEEDS,ADDRESS and FAMILY)*/