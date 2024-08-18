# TODO ----------------------
- TenantSetupComposer -> SetupComposer
- Info image aws upalod 




# Rates
tenant crerate at 4-may-24. next user lgoin in july. Is the rate imorted covering tJun-24?
UPDATE `setups` SET `last_rate_date` = '2024-05-01 00:00:00' WHERE `setups`.`id` = 1001;



# User
ok - Disbale user login stop?
- can register
- he can not login unless activate
- admin chagne user password
- backoffi change tenat admin passowrd
- from email verificatsion can login directly but not from login screen!
- user can only edit/cahgne password of owne
- admin can edit/cahgne password of all
- admin can not disbale own account


# PR
- delete pr and prl
- cancle pr: only approved. can not cancel if ocnverred 
- reject
- change curranc and update line and save
- in kpi: draft amount can not be shows as there might be non base curnet PR
-

# PO
- delete: only draft,only where is buyer, reset PR
- cancle: only approved. reverse everyting
- reject: reverse booking
- in kpi: draft amount can not be shows as there might be non base curnet PO
- 
- 
# POL
- line cancel is not allowd in apprved PO. workarodun cancel the PO then recreate.


# RECEIPT
- no delete:
- cancle: only reverse

# INVOCIE
- delete: only draft
- cancle: only posted. Not paid. reverse

# PAYMNET
- delete: No
- cancle: reverse
-132. allow only payment form same currencybanck account

 
# BUDGET
- make sure can not reduce budget below issues+bookingBudget
- Can not keep open multiple budget - test
- Can not open next year if previos year is open - tested


# Dept Budget
- can not edit if budget is closed - 
- can not edit if dept budget is closed - 


# PROJECT
- delete: No
- 

# ADMIN
- banner show

# WF
Anypo test case wf user inactive, 

# AEL
ael imported y/n


# item interface
- validated intems edit makes it draft


# Activity
- BIG issue iwth activty. not savign old value. move to manage.
- workaround-write to logn before update

# Uom
-- wont be able to edit or disable the class defaults
