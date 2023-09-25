<template>
  <div id="toPrint" class="m-10 mx-auto w-1/2">
    <div class="shadow rounded-lg">
      <br />
      <div class="flex grid grid-cols-3">
          <div class="w-28 ml-10 mt-4">
              <img src="/images/mu_white.png" alt="mitrf logo">
          </div>
          <div class="text-center ">
              <h1 class="font-extrabold text-sm">
                  M.I.T RETIREMENT FUND, INC.
              </h1>
              <h2 class=" text-sm">
                  Mapúa Institute of Technology <br />Muralla Street, Intramuros,
                  <br />Manila
              </h2>
              <br />

              <h2 class=" font-bold text-sm -mt-1">LOAN APPLICATION</h2>
          </div>
      </div>

      <form class="-mt-4">
        <div class="px-2 py-5 sm:p-6">
          <div class="grid grid-cols-6 gap-6">
            <div class="outline-double outline-4 mx-1 my-2 col-span-6"></div>

            <div class="flex col-span-3">
              <p class="font-semibold text-sm">Name of Borrower</p>
              <p class="ml-2 underline text-sm">
                {{ info.first_name }} {{ info.middle_name }}
                {{ info.last_name }}
              </p>
            </div>

            <div class="flex col-span-2">
              <p class="font-semibold text-sm">Date of Birth</p>
              <p class="ml-2 underline text-sm">{{ info.birth_date }}</p>
            </div>

            <div class="flex col-span-1">
              <p class="font-semibold text-sm">Age:</p>
              <p class="ml-2 underline text-sm">
                {{
                  new Date().getUTCFullYear() -
                  new Date(info.birth_date).getUTCFullYear()
                }}
              </p>
            </div>

            <div class="flex col-span-3">
              <p class="font-semibold text-sm">Date of Employment:</p>
              <p class="ml-2 underline text-sm">{{ info.employment }}</p>
            </div>

            <div class="flex col-span-3">
              <p class="font-semibold text-sm">Years of Service:</p>
              <p class="ml-2 underline text-sm">
                {{
                  new Date().getUTCFullYear() -
                  new Date(info.employment).getUTCFullYear()
                }}
                Years
              </p>
            </div>

            <div class="flex col-span-6">
              <p class="font-semibold text-sm">Department:</p>
              <p class="ml-2 underline text-sm">{{ info.department }}</p>
            </div>

            <div class="flex col-span-3">
              <p class="font-semibold text-sm">Amount of Loan</p>
              <p class="ml-2 underline text-sm">
                ₱ {{ loan.amount.toLocaleString("en-US") }}.00
              </p>
            </div>

            <div class="flex col-span-3">
              <p class="font-semibold text-sm">Term of Payment &lpar;Months&rpar;</p>
              <p class="ml-2 underline text-sm">{{ loan.duration }}</p>
            </div>

            <div class="flex col-span-4 mt-1">
              <p class="text-justify indent-10 text-sm">
                I hereby authorize the MITRF to collect and process the above
                information for legitimate purposes specifically for evaluation
                of my loan application and allow authorized personnel to process
                such information in accordance with the Data Privacy Act of
                2012.
              </p>
            </div>

            <div class="col-span-2 mt-1">
              <br />
              <div class="border-b-2 text-center font-bold text-sm">
                {{
                  info.first_name +
                  " " +
                  info.middle_name +
                  " " +
                  info.last_name
                }}
              </div>
              <p class="text-center italic text-sm">
                &lpar;Signature of Applicant&rpar;
              </p>
            </div>

            <div class="outline-double outline-4 mx-1 my-2 col-span-6"></div>

            <div class="flex col-span-6">
              <p class="italic text-sm -mt-2">
                &lpar;To be filled up by credit committee&rpar;
              </p>
            </div>

            <div class="flex col-span-6 -mt-4">
              <p class="font-bold text-sm">APPROVED,</p>
              &nbsp;
              <p class=" text-sm">subject to the following terms and conditions:</p>
            </div>
            <div class="flex col-span-6 pl-5 text-sm">
              <ol>
                <li class="flex -mt-4">
                  1. Amount of Loan &lpar;₱
                  <p class="underline">{{ loan.amount.toLocaleString("en-US") }}.00</p>
                  &rpar;
                </li>
                <li>2. Balance of Previous Loan &lpar;₱___________&rpar;</li>
                <li class="flex">
                  3. Net Amount due to Borrower &lpar;₱
                  <p class="underline">{{ loan.loan_amount.toLocaleString("en-US") }}.00</p>
                  &rpar;
                </li>
                <li class="flex">
                  4. Monthly Amortization for &lpar;
                  <p class="underline">{{ loan.duration }}</p>
                  &rpar; months
                </li>
                <li>
                  5. Payment of Amortization to start on the _____ day of
                  _____________, and to end on the _____ day of _____________.
                </li>
              </ol>
            </div>

            <div class="col-span-3 col-start-4 text-sm -mt-2">
              <p class="font-semibold">CREDIT COMMITTEE</p>
              <p>By:</p>
              <br />

              <div class="border-b-2 mx-10 text-center font-bold text-sm">{{this.board.committee_chairman}}</div>
              <p class="text-center">Committee Chairman</p>
              <br />
              <div class="border-b-2 mx-10"></div>
              <p class="text-center">Member</p>
            </div>

            <div class="col-span-3 -mt-5">
              <div class="border-b-2 mx-10 text-center font-bold text-sm">{{this.board.chairman}}</div>
              <p class="text-center">Chairman, Board of Directors</p>
            </div>
            <div class="col-span-3 text-sm">
              <div class="border-b-2 mx-10"></div>
              <p class="text-center">Member</p>
            </div>
            <br />
          </div>
        </div>
      </form>
    </div>

    <!-- Second Page -->
<!--    <p style="page-break-after: always">&nbsp;</p>-->
<!--    <p style="page-break-before: always">&nbsp;</p>-->

    <div class="shadow rounded-lg">
        <div class="flex grid grid-cols-3">
            <div class="w-28 ml-10 mt-4">
                <img src="/images/mu_white.png" alt="mitrf logo">
            </div>
            <div class="text-center mt-8">
                <h1 class=" font-bold text-sm">M.I.T RETIREMENT FUND, INC.</h1>
                <h2 class=" text-sm">
                    Mapúa Institute of Technology <br />Muralla Street, Intramuros,
                    <br />Manila
                </h2>
            </div>
        </div>
      <form>
        <div class="px-2 py-5 sm:p-6">
          <div class="grid grid-cols-6 gap-6">
            <div class="col-span-2">
              <p class="font-bold text-sm">NON-NEGOTIABLE</p>
            </div>

            <div class="col-span-2 col-start-5 text-right">
              <p class=" text-sm">No. __________</p>
            </div>

            <div class="col-span-6 -mt-2">
              <p class="font-extrabold text-center text-sm">PROMISSORY NOTE</p>
            </div>

            <div class="col-span-2">
              <p class="overflow-clip text-sm">₱___________</p>
            </div>

            <div class="col-span-4 col-start-3 text-right">
              <p class=" text-sm">Date Granted: __________________</p>
            </div>

            <div class="col-span-6 text-sm">
              <p class=" text-sm">Maturity Date: ______________________________</p>
            </div>

            <div class="col-span-6">
              <p class="indent-10 text-justify text-sm">
                <span class="font-semibold text-sm"> NOB VALUE RECEIVED, </span>I hereby
                promise to pay M.I.T. RETIREMENT FUND, INC at its office at
                Muralla St., Intramuros, Manila, the sum of
                _____________________________________________ PESOS &lpar;₱
                <span class="italic text-sm">{{ loan.loan_amount.toLocaleString("en-US") }}.00</span> &rpar;,
                Philippine currency, plus interest and service charge at the
                rate of <span class="italic text-sm">{{ loan.interest * 100 }}</span
                >% and __________________, respectively in equal semi-monthly
                installments of __________________ &lpar;₱
                <span class="italic text-sm">{{ loan.amount.toLocaleString("en-US") }}.00</span> &rpar; commencing
                on ____________________________, ________ to
                ____________________, ________ and subject further to the
                following terms and conditions.
              </p>
              <br />

              <p class="indent-10 text-justify italic text-sm">
                The interest charge herein shall be subject in increase or
                reduction, depending on whatever policy M.I.T. RETIREMENT FUND,
                INC. may, in the future, adapt conformable to law, decree, or
                government regulation with regard to any increase or decrease in
                Central Bank interest or rediscounting rates. Interest not paid
                when due shall be added to, and become part of the principal and
                shall likewise bear interest at the same rate stipulated herein.
              </p>
              <br />

              <p class="indent-10 text-justify italic text-sm">
                I hereby authorize and empower M.I.T. RETIREMENT FUND, INC. to
                set off, with out notice, what is due irrespective of the date
                of maturity and whether or not this obligation is due, from
                whatever funds I may have with it.
              </p>
              <br />

              <p class="indent-10 text-justify italic text-sm">
                M.I.T. RETIREMENT FUND, INC. may accept partial payment, grant
                extension of time or make any other arrangement regarding
                payment of this note which shall not affect my obligation, nor
                be deemed a waiver or loss of any of its rights herein granted
                and M.I.T. RETIREMENT FUND, INC. further reserves the right to
                recourse against each and endorses hereof, who hereby waived
                demand, presentment, protest and shows notice of dishonor.
              </p>
              <br />

              <p class="indent-10 text-justify italic mb-1 text-sm">
                If this note is placed in the hands of an attorney for
                collection, I agree to pay the further sum of twenty-five
                percent &lpar;25%&rpar; of the amount due as attorney's fees,
                which shall not be less than ₱500.00, and in case of litigation,
                I agree to pay the costs of suit. Any action arising out of this
                note may be instituted in the proper court of Metro Manila, and
                in case of execution, I expressly waive the benefits of Section
                12, Rule 39 of the Rules of Court.
              </p>
            </div>

            <div class="col-span-3 col-start-4 ">
              <div class="border-b-2 mx-10 text-center font-bold text-sm -mt-4">
                {{
                  info.first_name +
                  " " +
                  info.middle_name +
                  " " +
                  info.last_name
                }}
              </div>
              <p class="text-center text-sm">&lpar;Borrower&rpar;</p>
              <p class="text-center text-sm">&lpar;Print Name and Sign Above&rpar;</p>
            </div>

            <div class="col-span-6 text-center font-bold mb-2 text-sm">
              SIGNED IN THE PRESENCE OF:
            </div>


          </div>
        </div>
      </form>
    </div>
    <br />
    <!-- Third Page -->

    <div class="shadow rounded-lg">
      <br />
       <div class="flex grid grid-cols-3">
           <div class="w-28 ml-10 mt-4">
               <img src="/images/mu_white.png" alt="mitrf logo">
           </div>
           <div class="text-center mt-8">
               <h1 class=" font-bold text-sm">M.I.T RETIREMENT FUND, INC.</h1>
               <h2 class=" text-sm">
                   Mapúa Institute of Technology <br />Muralla Street, Intramuros,
                   <br />Manila
               </h2>
           </div>
       </div>

      <form>
        <div class="px-2 py-5 sm:p-6">
          <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6">
              <p class="font-extrabold text-center text-sm">ASSIGNMENT</p>
              <br />

              <p class="indent-10 text-justify text-sm">
                I,
                <span class="underline italic" >{{
                    info.first_name +
                    " " +
                    info.middle_name +
                    " " +
                    info.last_name
                  }} </span>, ____________________________________________
              </p>

              <p class="text-center flex text-sm">
                <span class="mx-24">&lpar;Name&rpar; </span>
                <span class="mx-40">&lpar;Designation&rpar;</span>
              </p>
              <p class="text-justify text-sm">
                of _______________________________, a member of M.I.T.
                RETIREMENT FUND, INC. in the principal amount of PESOS
                _______________________________________________________, covered
                by Promissory Note No. ________________________________ granted
                on ________________________, ____________, hereby authorized
                MAPUA INSTITUTE OF TECHNOLOGY &lpar;MIT&rpar; to deduct from the
                monthly compensation or bonuses due me, the periodic
                amortization due under said promissory note until fully paid. It
                is understood that said deductions shall be remitted by MIT or
                M.I.T. RETIREMENT FUND, INC. in my payment of my above-mentioned
                loan.
              </p>
              <br />

              <p class="indent-10 text-justify text-sm">
                In the event that I fail to pay any or all the amortization due
                under said note, I further authorize the Board of Directors of
                the M.I.T. RETIREMENT FUND, INC. to apply the benefits that may
                due me or my beneficiary/ies under said RETIREMENT FUND in such
                amount as may be necessary to liquidate my outstanding
                obligation under said promissory note.
              </p>
              <br /><br />
            </div>

            <div class="col-span-3 col-start-4">
              <div class="border-b-2 mx-10 text-center font-bold text-sm">
                {{
                  info.first_name +
                  " " +
                  info.middle_name +
                  " " +
                  info.last_name
                }}
              </div>
              <p class="text-center text-sm">&lpar;Borrower&rpar;</p>
              <p class="text-center text-sm">&lpar;Print Name and Sign Above&rpar;</p>
              <br /><br />
            </div>

            <div class="col-span-3">
              <p class="font-bold text-sm">CONFORME:</p>
              <br />
              <p class="font-bold text-sm">MAPUA INSTITUTE OF TECHNOLOGY</p>
              <p class=" text-sm"> </p>
              <br /><br />

              <div class="border-b-2 mx-10 text-sm text-center font-bold">{{this.board.treasurer}}</div>
              <p class="text-center text-sm">&lpar;Treasurer&rpar;</p>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>
<script>
export default {
  setup() {},
  props: {
    loan: Object,
    info: Object,
    board:Object,
  },
};
</script>
<style scoped>
@media print {
  #toPrint {
    width: 90% !important;
    height: 100% !important;
    margin: 5% !important;
    padding: 0% !important;
  }
}
</style>
