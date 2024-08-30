# TODO ----------------------
- TenantSetupComposer -> SetupComposer
- Info image aws upload 




# Rates
tenant created at 4-may-24. next user login in july. Is the rate imported covering tJun-24?
UPDATE `setups` SET `last_rate_date` = '2024-05-01 00:00:00' WHERE `setups`.`id` = 1001;



# User
ok - Disable user login stop?
- can register
- he can not login unless activate
- admin change user password
- back-office change tenant admin password
- from email verification can login directly but not from login screen!
- user can only edit/change password of owner
- admin can edit/change password of all
- admin can not disable own account


# PR
- delete pr and prl
- cancel pr: only approved. can not cancel if converted 
- reject
- change currency and update line and save
- in kpi: draft amount can not be shows as there might be non base current PR
-

# PO
- delete: only draft,only where is buyer, reset PR
- cancel: only approved. reverse everything
- reject: reverse booking
- in kpi: draft amount can not be shows as there might be non base current PO
- 
- 
# POL
- line cancel is not allowed in approved PO. workaround cancel the PO then recreate.


# RECEIPT
- no delete:
- cancel: only reverse

# INVOCIE
- delete: only draft
- cancle: only posted. Not paid. reverse

# PAYMNET
- delete: No
- cancel: reverse
-132. allow only payment form same currency bank account

 
# BUDGET
- make sure can not reduce budget below issues+bookingBudget
- Can not keep open multiple budget - test
- Can not open next year if previous year is open - tested


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
- validated items edit makes it draft


# Activity
- BIG issue with activity. not saving old value. move to manage.
- workaround-write to logon before update

# Uom
-- wont be able to edit or disable the class defaults
