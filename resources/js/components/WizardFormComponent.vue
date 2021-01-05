<template>
    <div class="container w-75">
        <transition name="wizard-form" mode="out-in">
            <div v-if="show == 0" key="first-form" class="container w-50  mb-4">
                <h1 class="border-bottom mt-3 pb-4 text-center" id="header">
                    To participate in the conference, please fill out the form
                </h1> 
                <form id="firstForm" @submit.prevent="submit('/add-user', 'firstForm')" class="border border-top-0 border-secondary rounded-bottom p-5">
                    
                    <div class="form-group">
                        <label for="firstname">Firstname</label>
                        <input type="text" class="form-control" v-model="fields.firstname" name="firstname"
                            :class="{'border border-danger': errors && errors.firstname}">
                        <div v-if="errors && errors.firstname" class="text-danger"> {{errors.firstname[0]}} </div>
                    </div>

                    <div class="form-group">
                        <label for="lastname">Lastname</label>
                        <input type="text" class="form-control" v-model="fields.lastname" name="lastname"
                            :class="{'border border-danger ': errors && errors.lastname}">
                        <div v-if="errors && errors.lastname" class="text-danger"> {{errors.lastname[0]}} </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="birthdate">Birthdate</label>
                        <date-picker type="date" class="w-100" v-model="fields.birthdate"
                            :class="{'border border-danger rounded': errors && errors.birthdate}"
                            :input-class = "'form-control'"
                            :input-attr	= "{name: 'birthdate'}"
                        >
                        </date-picker>
                        <div v-if="errors && errors.birthdate" class="text-danger"> {{errors.birthdate[0]}} </div>
                    </div>

                    <div class="form-group">
                        <label for="report_subject">Report subject</label>
                        <input type="text" class="form-control" v-model="fields.report_subject" name="report_subject"
                            :class="{'border border-danger': errors && errors.report_subject}">
                        <div v-if="errors && errors.report_subject" class="text-danger"> {{errors.report_subject[0]}} </div>
                    </div>

                    <div class="form-group">
                        <label for="country">Country</label>
                        <select class="form-control custom-select" v-model="fields.country" name="country"
                            :class="{'border border-danger ': errors && errors.country}">
                            <option v-for="(country, index) in countries" :key="index">
                                {{country.name}}
                            </option>
                        </select>

                        <div v-if="errors && errors.country" class="text-danger"> {{errors.country[0]}} </div>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <div class="rounded" :class="{'border border-danger': errors && errors.phone}">
                            <the-mask class="form-control" name="phone" :mask="['+# (###) ###-####']"/>    
                        </div>
                        <div v-if="errors && errors.phone" class="text-danger"> {{errors.phone[0]}} </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" v-model="fields.email" name="email"
                            :class="{'border border-danger': errors && errors.email}">
                        <div v-if="errors && errors.email" class="text-danger"> {{errors.email[0]}} </div>
                    </div>
                    
                    <div class="form-group d-flex flex-row-reverse">
                        <button type="submit" class="btn btn-primary btn-lg" >Next</button>
                    </div>
                </form>
            </div>


            <div v-if="show == 1" key="second-form" class=" container w-50 mb-4">
                <form id="secondForm" @submit.prevent="submit('/add-info', 'secondForm')" class="border border-top-0  border-secondary rounded-bottom p-5" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="company">Company</label>
                        <input type="text" class="form-control" v-model="fields.company" name="company"
                            :class="{'border border-danger': errors && errors.company}">
                        <div v-if="errors && errors.company" class="text-danger"> {{errors.company[0]}} </div>
                    </div>
        
                    <div class="form-group">
                        <label for="position">Position</label>
                        <input type="text" class="form-control" v-model="fields.position" name="position"
                            :class="{'border border-danger': errors && errors.position}">
                        <div v-if="errors && errors.position" class="text-danger"> {{errors.position[0]}} </div>
                    </div>
                    <div class="form-group">
                        <label for="about">About me</label>
                        <textarea type=""  class="form-control" v-model="fields.about" name="about"
                            :class="{'border border-danger': errors && errors.about}"></textarea>
                        <div v-if="errors && errors.about" class="text-danger"> {{errors.about[0]}} </div>
                    </div>
        
                    <div class="form-group">
                        <label for="photo">Photo</label>
                        <div class="custom-file">
                            <input 
                                id="uploadimage"
                                type="file"
                                class="form-control img-input custom-file-input"
                                name="photo"
                                >
                            <label class="custom-file-label" for="inputGroupFile01" :class="{'border border-danger': errors && errors.photo}">Choose file</label>
                            <div v-if="errors && errors.photo" class="text-danger"> {{errors.photo[0]}} </div>
                        </div>
                        <small class="form-text text-muted">Pleace select photo (.png, .jpeg, .jpg, .gif) with maximum size of {{uploadMaxFilesize}}.</small>

                    </div>

                    <div class="form-group d-flex flex-row-reverse">
                        <button type="submit" class="btn btn-primary btn-lg">Next</button>
                    </div>
                </form>
            </div>

            <div v-if="show == 2" key="share" class=" d-flex  flex-column mt-5">
                <div class="d-flex justify-content-center">
                    <a class="btn"
                    :href="'https://twitter.com/intent/tweet?text=' + twitMessage">
                        <i class="fab fa-twitter-square fa-10x text-primary"></i>
                    </a>
                    
                    <a class="btn"
                        :href="'https://www.facebook.com/sharer/sharer.php?u=' + facebookUrl"
                        target="_blank">
                        <i class="fab fa-facebook-square fa-10x text-primary"></i>
                    </a>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    <a href="/" class="mr-2">
                        <button type="button" class="btn btn-primary btn-lg">
                            Back
                        </button>
                    </a>

                    <a class="text-center d-flex align-items-center" href="all-members">
                        <h3>All members ({{membersAmount}})</h3>
                    </a>
                </div>
            </div>
        </transition>

    </div>
</template>

<script>

import axios from 'axios';
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
   

export default {
    components: { DatePicker },
    props: [
        'csrf',
        'membersAmount',
        'uploadMaxFilesize',
        'twitMessage',
        'facebookUrl'
        ],
    data() {
        return {
            show: localStorage.page || 0,
            fields: {},
            errors: {},
            countries: [ 
                    {name: 'Afghanistan', code: 'AF'}, 
                    {name: 'Åland Islands', code: 'AX'}, 
                    {name: 'Albania', code: 'AL'}, 
                    {name: 'Algeria', code: 'DZ'}, 
                    {name: 'American Samoa', code: 'AS'}, 
                    {name: 'AndorrA', code: 'AD'}, 
                    {name: 'Angola', code: 'AO'}, 
                    {name: 'Anguilla', code: 'AI'}, 
                    {name: 'Antarctica', code: 'AQ'}, 
                    {name: 'Antigua and Barbuda', code: 'AG'}, 
                    {name: 'Argentina', code: 'AR'}, 
                    {name: 'Armenia', code: 'AM'}, 
                    {name: 'Aruba', code: 'AW'}, 
                    {name: 'Australia', code: 'AU'}, 
                    {name: 'Austria', code: 'AT'}, 
                    {name: 'Azerbaijan', code: 'AZ'}, 
                    {name: 'Bahamas', code: 'BS'}, 
                    {name: 'Bahrain', code: 'BH'}, 
                    {name: 'Bangladesh', code: 'BD'}, 
                    {name: 'Barbados', code: 'BB'}, 
                    {name: 'Belarus', code: 'BY'}, 
                    {name: 'Belgium', code: 'BE'}, 
                    {name: 'Belize', code: 'BZ'}, 
                    {name: 'Benin', code: 'BJ'}, 
                    {name: 'Bermuda', code: 'BM'}, 
                    {name: 'Bhutan', code: 'BT'}, 
                    {name: 'Bolivia', code: 'BO'}, 
                    {name: 'Bosnia and Herzegovina', code: 'BA'}, 
                    {name: 'Botswana', code: 'BW'}, 
                    {name: 'Bouvet Island', code: 'BV'}, 
                    {name: 'Brazil', code: 'BR'}, 
                    {name: 'British Indian Ocean Territory', code: 'IO'}, 
                    {name: 'Brunei Darussalam', code: 'BN'}, 
                    {name: 'Bulgaria', code: 'BG'}, 
                    {name: 'Burkina Faso', code: 'BF'}, 
                    {name: 'Burundi', code: 'BI'}, 
                    {name: 'Cambodia', code: 'KH'}, 
                    {name: 'Cameroon', code: 'CM'}, 
                    {name: 'Canada', code: 'CA'}, 
                    {name: 'Cape Verde', code: 'CV'}, 
                    {name: 'Cayman Islands', code: 'KY'}, 
                    {name: 'Central African Republic', code: 'CF'}, 
                    {name: 'Chad', code: 'TD'}, 
                    {name: 'Chile', code: 'CL'}, 
                    {name: 'China', code: 'CN'}, 
                    {name: 'Christmas Island', code: 'CX'}, 
                    {name: 'Cocos (Keeling) Islands', code: 'CC'}, 
                    {name: 'Colombia', code: 'CO'}, 
                    {name: 'Comoros', code: 'KM'}, 
                    {name: 'Congo', code: 'CG'}, 
                    {name: 'Congo, The Democratic Republic of the', code: 'CD'}, 
                    {name: 'Cook Islands', code: 'CK'}, 
                    {name: 'Costa Rica', code: 'CR'}, 
                    {name: 'Cote D\'Ivoire', code: 'CI'}, 
                    {name: 'Croatia', code: 'HR'}, 
                    {name: 'Cuba', code: 'CU'}, 
                    {name: 'Cyprus', code: 'CY'}, 
                    {name: 'Czech Republic', code: 'CZ'}, 
                    {name: 'Denmark', code: 'DK'}, 
                    {name: 'Djibouti', code: 'DJ'}, 
                    {name: 'Dominica', code: 'DM'}, 
                    {name: 'Dominican Republic', code: 'DO'}, 
                    {name: 'Ecuador', code: 'EC'}, 
                    {name: 'Egypt', code: 'EG'}, 
                    {name: 'El Salvador', code: 'SV'}, 
                    {name: 'Equatorial Guinea', code: 'GQ'}, 
                    {name: 'Eritrea', code: 'ER'}, 
                    {name: 'Estonia', code: 'EE'}, 
                    {name: 'Ethiopia', code: 'ET'}, 
                    {name: 'Falkland Islands (Malvinas)', code: 'FK'}, 
                    {name: 'Faroe Islands', code: 'FO'}, 
                    {name: 'Fiji', code: 'FJ'}, 
                    {name: 'Finland', code: 'FI'}, 
                    {name: 'France', code: 'FR'}, 
                    {name: 'French Guiana', code: 'GF'}, 
                    {name: 'French Polynesia', code: 'PF'}, 
                    {name: 'French Southern Territories', code: 'TF'}, 
                    {name: 'Gabon', code: 'GA'}, 
                    {name: 'Gambia', code: 'GM'}, 
                    {name: 'Georgia', code: 'GE'}, 
                    {name: 'Germany', code: 'DE'}, 
                    {name: 'Ghana', code: 'GH'}, 
                    {name: 'Gibraltar', code: 'GI'}, 
                    {name: 'Greece', code: 'GR'}, 
                    {name: 'Greenland', code: 'GL'}, 
                    {name: 'Grenada', code: 'GD'}, 
                    {name: 'Guadeloupe', code: 'GP'}, 
                    {name: 'Guam', code: 'GU'}, 
                    {name: 'Guatemala', code: 'GT'}, 
                    {name: 'Guernsey', code: 'GG'}, 
                    {name: 'Guinea', code: 'GN'}, 
                    {name: 'Guinea-Bissau', code: 'GW'}, 
                    {name: 'Guyana', code: 'GY'}, 
                    {name: 'Haiti', code: 'HT'}, 
                    {name: 'Heard Island and Mcdonald Islands', code: 'HM'}, 
                    {name: 'Holy See (Vatican City State)', code: 'VA'}, 
                    {name: 'Honduras', code: 'HN'}, 
                    {name: 'Hong Kong', code: 'HK'}, 
                    {name: 'Hungary', code: 'HU'}, 
                    {name: 'Iceland', code: 'IS'}, 
                    {name: 'India', code: 'IN'}, 
                    {name: 'Indonesia', code: 'ID'}, 
                    {name: 'Iran, Islamic Republic Of', code: 'IR'}, 
                    {name: 'Iraq', code: 'IQ'}, 
                    {name: 'Ireland', code: 'IE'}, 
                    {name: 'Isle of Man', code: 'IM'}, 
                    {name: 'Israel', code: 'IL'}, 
                    {name: 'Italy', code: 'IT'}, 
                    {name: 'Jamaica', code: 'JM'}, 
                    {name: 'Japan', code: 'JP'}, 
                    {name: 'Jersey', code: 'JE'}, 
                    {name: 'Jordan', code: 'JO'}, 
                    {name: 'Kazakhstan', code: 'KZ'}, 
                    {name: 'Kenya', code: 'KE'}, 
                    {name: 'Kiribati', code: 'KI'}, 
                    {name: 'Korea, Democratic People\'S Republic of', code: 'KP'}, 
                    {name: 'Korea, Republic of', code: 'KR'}, 
                    {name: 'Kuwait', code: 'KW'}, 
                    {name: 'Kyrgyzstan', code: 'KG'}, 
                    {name: 'Lao People\'S Democratic Republic', code: 'LA'}, 
                    {name: 'Latvia', code: 'LV'}, 
                    {name: 'Lebanon', code: 'LB'}, 
                    {name: 'Lesotho', code: 'LS'}, 
                    {name: 'Liberia', code: 'LR'}, 
                    {name: 'Libyan Arab Jamahiriya', code: 'LY'}, 
                    {name: 'Liechtenstein', code: 'LI'}, 
                    {name: 'Lithuania', code: 'LT'}, 
                    {name: 'Luxembourg', code: 'LU'}, 
                    {name: 'Macao', code: 'MO'}, 
                    {name: 'Macedonia, The Former Yugoslav Republic of', code: 'MK'}, 
                    {name: 'Madagascar', code: 'MG'}, 
                    {name: 'Malawi', code: 'MW'}, 
                    {name: 'Malaysia', code: 'MY'}, 
                    {name: 'Maldives', code: 'MV'}, 
                    {name: 'Mali', code: 'ML'}, 
                    {name: 'Malta', code: 'MT'}, 
                    {name: 'Marshall Islands', code: 'MH'}, 
                    {name: 'Martinique', code: 'MQ'}, 
                    {name: 'Mauritania', code: 'MR'}, 
                    {name: 'Mauritius', code: 'MU'}, 
                    {name: 'Mayotte', code: 'YT'}, 
                    {name: 'Mexico', code: 'MX'}, 
                    {name: 'Micronesia, Federated States of', code: 'FM'}, 
                    {name: 'Moldova, Republic of', code: 'MD'}, 
                    {name: 'Monaco', code: 'MC'}, 
                    {name: 'Mongolia', code: 'MN'}, 
                    {name: 'Montserrat', code: 'MS'}, 
                    {name: 'Morocco', code: 'MA'}, 
                    {name: 'Mozambique', code: 'MZ'}, 
                    {name: 'Myanmar', code: 'MM'}, 
                    {name: 'Namibia', code: 'NA'}, 
                    {name: 'Nauru', code: 'NR'}, 
                    {name: 'Nepal', code: 'NP'}, 
                    {name: 'Netherlands', code: 'NL'}, 
                    {name: 'Netherlands Antilles', code: 'AN'}, 
                    {name: 'New Caledonia', code: 'NC'}, 
                    {name: 'New Zealand', code: 'NZ'}, 
                    {name: 'Nicaragua', code: 'NI'}, 
                    {name: 'Niger', code: 'NE'}, 
                    {name: 'Nigeria', code: 'NG'}, 
                    {name: 'Niue', code: 'NU'}, 
                    {name: 'Norfolk Island', code: 'NF'}, 
                    {name: 'Northern Mariana Islands', code: 'MP'}, 
                    {name: 'Norway', code: 'NO'}, 
                    {name: 'Oman', code: 'OM'}, 
                    {name: 'Pakistan', code: 'PK'}, 
                    {name: 'Palau', code: 'PW'}, 
                    {name: 'Palestinian Territory, Occupied', code: 'PS'}, 
                    {name: 'Panama', code: 'PA'}, 
                    {name: 'Papua New Guinea', code: 'PG'}, 
                    {name: 'Paraguay', code: 'PY'}, 
                    {name: 'Peru', code: 'PE'}, 
                    {name: 'Philippines', code: 'PH'}, 
                    {name: 'Pitcairn', code: 'PN'}, 
                    {name: 'Poland', code: 'PL'}, 
                    {name: 'Portugal', code: 'PT'}, 
                    {name: 'Puerto Rico', code: 'PR'}, 
                    {name: 'Qatar', code: 'QA'}, 
                    {name: 'Reunion', code: 'RE'}, 
                    {name: 'Romania', code: 'RO'}, 
                    {name: 'Russian Federation', code: 'RU'}, 
                    {name: 'RWANDA', code: 'RW'}, 
                    {name: 'Saint Helena', code: 'SH'}, 
                    {name: 'Saint Kitts and Nevis', code: 'KN'}, 
                    {name: 'Saint Lucia', code: 'LC'}, 
                    {name: 'Saint Pierre and Miquelon', code: 'PM'}, 
                    {name: 'Saint Vincent and the Grenadines', code: 'VC'}, 
                    {name: 'Samoa', code: 'WS'}, 
                    {name: 'San Marino', code: 'SM'}, 
                    {name: 'Sao Tome and Principe', code: 'ST'}, 
                    {name: 'Saudi Arabia', code: 'SA'}, 
                    {name: 'Senegal', code: 'SN'}, 
                    {name: 'Serbia and Montenegro', code: 'CS'}, 
                    {name: 'Seychelles', code: 'SC'}, 
                    {name: 'Sierra Leone', code: 'SL'}, 
                    {name: 'Singapore', code: 'SG'}, 
                    {name: 'Slovakia', code: 'SK'}, 
                    {name: 'Slovenia', code: 'SI'}, 
                    {name: 'Solomon Islands', code: 'SB'}, 
                    {name: 'Somalia', code: 'SO'}, 
                    {name: 'South Africa', code: 'ZA'}, 
                    {name: 'South Georgia and the South Sandwich Islands', code: 'GS'}, 
                    {name: 'Spain', code: 'ES'}, 
                    {name: 'Sri Lanka', code: 'LK'}, 
                    {name: 'Sudan', code: 'SD'}, 
                    {name: 'Suriname', code: 'SR'}, 
                    {name: 'Svalbard and Jan Mayen', code: 'SJ'}, 
                    {name: 'Swaziland', code: 'SZ'}, 
                    {name: 'Sweden', code: 'SE'}, 
                    {name: 'Switzerland', code: 'CH'}, 
                    {name: 'Syrian Arab Republic', code: 'SY'}, 
                    {name: 'Taiwan, Province of China', code: 'TW'}, 
                    {name: 'Tajikistan', code: 'TJ'}, 
                    {name: 'Tanzania, United Republic of', code: 'TZ'}, 
                    {name: 'Thailand', code: 'TH'}, 
                    {name: 'Timor-Leste', code: 'TL'}, 
                    {name: 'Togo', code: 'TG'}, 
                    {name: 'Tokelau', code: 'TK'}, 
                    {name: 'Tonga', code: 'TO'}, 
                    {name: 'Trinidad and Tobago', code: 'TT'}, 
                    {name: 'Tunisia', code: 'TN'}, 
                    {name: 'Turkey', code: 'TR'}, 
                    {name: 'Turkmenistan', code: 'TM'}, 
                    {name: 'Turks and Caicos Islands', code: 'TC'}, 
                    {name: 'Tuvalu', code: 'TV'}, 
                    {name: 'Uganda', code: 'UG'}, 
                    {name: 'Ukraine', code: 'UA'}, 
                    {name: 'United Arab Emirates', code: 'AE'}, 
                    {name: 'United Kingdom', code: 'GB'}, 
                    {name: 'United States', code: 'US'}, 
                    {name: 'United States Minor Outlying Islands', code: 'UM'}, 
                    {name: 'Uruguay', code: 'UY'}, 
                    {name: 'Uzbekistan', code: 'UZ'}, 
                    {name: 'Vanuatu', code: 'VU'}, 
                    {name: 'Venezuela', code: 'VE'}, 
                    {name: 'Viet Nam', code: 'VN'}, 
                    {name: 'Virgin Islands, British', code: 'VG'}, 
                    {name: 'Virgin Islands, U.S.', code: 'VI'}, 
                    {name: 'Wallis and Futuna', code: 'WF'}, 
                    {name: 'Western Sahara', code: 'EH'}, 
                    {name: 'Yemen', code: 'YE'}, 
                    {name: 'Zambia', code: 'ZM'}, 
                    {name: 'Zimbabwe', code: 'ZW'} 
            ]
        }
    },

    methods: {
        submit(url, id) {
            let form = document.getElementById(id);
            let formData = new FormData(form);
            axios.post(
                url,
                formData,{
                    headers: {
                        'X-CSRF-TOKEN': this.csrf,
                        'content-type': 'multipart/form-data'
                    }
                }
            ).then(
                response => {
                    this.show ++ ;
                    localStorage.page = this.show;
                    this.fields = {};
                    if (this.show == 2) {
                        localStorage.page = 0;
                    }
                }
            ).catch(
                error => {
                    this.errors = error.response.data.errors;
                }
            );
        },
    },
}
</script>